import 'dart:convert';
import 'dart:io';
import 'dart:async';
import 'package:http/http.dart';
import 'package:http/io_client.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import '../auth_provider.dart';
import 'package:flutter_dotenv/flutter_dotenv.dart';


class BaseProvider<T> with ChangeNotifier {
  String? baseUrl;
  String? endpoint;

  HttpClient client = new HttpClient();
  IOClient? http;

  BaseProvider(String this.endpoint) {
    baseUrl = dotenv.env['API_URL'];
    client.badCertificateCallback = (cert, host, port) => true;
    http = IOClient(client);
  }

  Future<T> getById(int id, [dynamic additionalData]) async {
    var url = Uri.parse("$baseUrl/$endpoint/$id");

    Map<String, String> headers = createHeaders();
    var response = await http!.get(url, headers: headers);

    if (isValidResponseCode(response)) {
      var data = jsonDecode(response.body);
      return fromJson(data) as T;
    }
    else {
      throw Exception("Error while trying to fetch data by id for entry of type $endpoint");
    }
  }

  Future<List<T>> get(pageNumber, pageSize, [dynamic search]) async {
    var url = "$baseUrl/$endpoint/$pageNumber/$pageSize";

    if (search != null) {
      String queryString = getQueryString(search);
      url = url + "?" + queryString;
    }
    var uri = Uri.parse(url);

    Map<String, String> headers = createHeaders();
    var response = await http!.get(uri, headers: headers);

    if (isValidResponseCode(response)) {
      var data = jsonDecode(response.body);
      return data.map((x) => fromJson(x)).cast<T>().toList();
    }
    else {
      throw Exception("Error while trying to fetch data for entry of type $endpoint");
    }
  }

  Future<T?> insert(dynamic request) async {
    var uri = Uri.parse("$baseUrl/$endpoint");

    Map<String, String> headers = createHeaders();
    var jsonRequest = jsonEncode(request);
    var response = await http!.post(uri, headers: headers, body: jsonRequest);

    if (isValidResponseCode(response)) {
      var data = jsonDecode(response.body);
      return fromJson(data) as T;
    }
    else {
      throw Exception("Error while trying to insert data for entry of type $endpoint");
    }
  }

  Future<T?> update(int id, [dynamic request]) async {
    var url = "$baseUrl/$endpoint/$id";
    var uri = Uri.parse(url);
    Map<String, String> headers = createHeaders();
    var response =
    await http!.put(uri, headers: headers, body: jsonEncode(request));

    if (isValidResponseCode(response)) {
      var data = jsonDecode(response.body);
      return fromJson(data) as T;
    }
    else {
      throw Exception("Error while trying to update data for entry of type $endpoint");
    }
  }

  Future<bool> delete(int id) async {
    var url = "$baseUrl/$endpoint/$id";
    var uri = Uri.parse(url);

    Map<String, String> headers = createHeaders();

    var response = await http!.delete(uri, headers: headers);

    if (isValidResponseCode(response)) {
      return true;
    }
    else {
      throw Exception("Error while trying to delete data for entry of type $endpoint");
    }
  }

  Map<String, String> createHeaders() {

    String basicAuth = "Bearer ${AuthProvider.data!.token}";

    var headers = {
      "Accept":"application/json",
      "Content-Type": "application/json",
      "Authorization": basicAuth
    };
    return headers;
  }

  T fromJson(data) {
    // Each entity will have it's own implementation of fromJson method in order to properly convert data.
    throw Exception("Override method");
  }

  String getQueryString(Map params, {String prefix= '&', bool inRecursion= false}) {
    String query = '';
    params.forEach((key, value) {
      if (inRecursion) {
        if (key is int) {
          key = '[$key]';
        }
        else if (value is List || value is Map) {
          key = '.$key';
        }
        else {
          key = '.$key';
        }
      }
      if (value is String || value is int || value is double || value is bool) {
        var encoded = value;
        if (value is String) {
          encoded = Uri.encodeComponent(value);
        }
        query += '$prefix$key=$encoded';
      } else if (value is DateTime) {
        query += '$prefix$key=${(value as DateTime).toIso8601String()}';
      } else if (value is List || value is Map) {
        if (value is List) value = value.asMap();
        value.forEach((k, v) {
          query +=
              getQueryString({k: v}, prefix: '$prefix$key', inRecursion: true);
        });
      }
    });
    return query;
  }

  bool isValidResponseCode(Response response) {
    if (response.statusCode == 200) {
      if (response.body != "") {
        return true;
      } else {
        return false;
      }
    } else if (response.statusCode == 204) {
      return true;
    } else if (response.statusCode == 400) {
      throw Exception("Bad request");
    } else if (response.statusCode == 401) {
      throw Exception("Unauthorized");
    } else if (response.statusCode == 403) {
      throw Exception("Forbidden");
    } else if (response.statusCode == 404) {
      throw Exception("Not found");
    } else if (response.statusCode == 500) {
      throw Exception("Internal server error");
    } else {
      throw Exception("Unhandled exception, contact support");
    }
  }
}