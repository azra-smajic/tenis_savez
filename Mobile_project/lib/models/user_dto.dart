class UserDto {
  String id;
  String first_name;
  String last_name;
  String birth_year;
  String sex;
  String phone_number;
  String email;

  UserDto({
    required this.id,
    required this.first_name,
    required this.last_name,
    required this.birth_year,
    required this.sex,
    required this.phone_number,
    required this.email,
  });

  factory UserDto.fromJson(Map<String, dynamic> json) {
    return UserDto(
        id: json['id'],
        first_name: json['first_name'],
        last_name: json['last_name'],
        birth_year: json['birth_year'],
        sex: json['sex'],
        phone_number: json['phone_number'],
        email: json['email']
    );
  }
}
