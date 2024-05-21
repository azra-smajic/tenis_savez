import 'dart:convert';
import 'package:flutter/foundation.dart' show kIsWeb;
import 'package:http/http.dart' as http;
import 'package:mobile_project/models/login_dto.dart';
import '../models/sign_in_data.dart';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:localstorage/localstorage.dart';

class AuthProvider  {
  static SuccessSignInData? data = null;

  static Future<bool> signIn(LoginDto loginDto) async {
    var baseUrl = !kIsWeb ? dotenv.env['API_URL_MOBILE']! : dotenv.env['API_URL_ADMIN']!;
    final url = Uri.parse(baseUrl! + '/login');

    try {
      final response = await http.post(
        url,
        headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
        body: json.encode(loginDto.toJson()),
      );
      if (response.statusCode >= 200 && response.statusCode < 300) {
        final Map<String, dynamic> responseJson = json.decode(response.body);
        data = SuccessSignInData.fromJson(responseJson);
        localStorage.setItem('token', data!.token);
        return true;
      }
      else {
        return false;
      }
    }
    catch (error) {
      return false;
    }
  }

}