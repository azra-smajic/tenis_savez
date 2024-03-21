import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:mobile_project/models/login_dto.dart';
import 'package:mobile_project/pages/HomePage.dart';
import 'package:mobile_project/providers/auth_provider.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';

class LoginPage extends StatefulWidget{

  @override
  _LoginPageState createState() => _LoginPageState();
}
class _LoginPageState extends State<LoginPage>{
  TextEditingController _emailController = TextEditingController();
  TextEditingController _passwordController = TextEditingController();

  @override
  void initState(){
  }

  Future<void> _handleSignIn() async {
    var loginDto = LoginDto(email : _emailController.text, password: _passwordController.text);
    var response = await AuthProvider.signIn(loginDto);
    print(response);
    if(response){
      Navigator.of(context).push(
          MaterialPageRoute(
            builder: (context) => HomePage(),
          ));
    }
    else{
          Fluttertoast.showToast(
          msg: AppLocalizations.of(context)!.loginError,
      );
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        padding: EdgeInsets.only(top: 200),
        child: Column(
          children: [
            TextFormField(
              controller: _emailController,
              decoration: InputDecoration(labelText: "Email"),
            ),
            TextFormField(
              controller: _passwordController,
              decoration: InputDecoration(labelText: "Lozinka")
            ),
            SizedBox(height: 20),
            ElevatedButton(onPressed: ()=>{
              _handleSignIn()
            }, child: Text("Prijavi se"))
          ],
        ),
      )
    );
  }
}