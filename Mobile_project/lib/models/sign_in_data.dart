import 'package:mobile_project/models/user_dto.dart';

class SuccessSignInData {
  final String token;
  final UserDto user;

  SuccessSignInData({
    required this.token,
    required this.user,
  });

  factory SuccessSignInData.fromJson(Map<String, dynamic> json) {
    return SuccessSignInData(
      token: json['token'],
      user: UserDto.fromJson(json['user'])
    );
  }
}
