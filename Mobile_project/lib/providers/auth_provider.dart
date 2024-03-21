import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:mobile_project/models/login_dto.dart';
import '../models/sign_in_data.dart';
import 'package:flutter_dotenv/flutter_dotenv.dart';

class AuthProvider  {
  static SuccessSignInData? data = null;

  static Future<bool> signIn(LoginDto loginDto) async {

    final url = Uri.parse(dotenv.env['API_URL']! + '/login');

    try {
      final response = await http.post(
        url,
        headers: {'Accept': 'application/json', 'Content-Type': 'application/json'},
        body: json.encode(loginDto.toJson()),
      );
      print(response.statusCode);
      if (response.statusCode >= 200 && response.statusCode < 300) {
        final Map<String, dynamic> responseJson = json.decode(response.body);
        data = SuccessSignInData.fromJson(responseJson);
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