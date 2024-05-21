import 'package:mobile_project/models/user_dto.dart';
import 'package:mobile_project/providers/baseProviders/base_provider.dart';

class PlayerProvider extends BaseProvider<UserDto>{
  PlayerProvider():super("users");

  @override
  UserDto fromJson(data) {
    return UserDto.fromJson(data);
  }
}