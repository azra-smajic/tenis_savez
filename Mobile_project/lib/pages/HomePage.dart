import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';

import 'SideBar.dart';

class HomePage extends StatefulWidget{
  @override
  _HomePageState createState() => _HomePageState();
}

class _HomePageState extends State<HomePage>{

  @override
  void initState(){
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Teniski savez'),
      ),
      body: Row(
        children: [
          Expanded(
            flex: 1,
            child: SideBar(),
          ),
          Expanded(
            flex: 3,
            child: Container(
              color: Colors.white, // Main content area
              child: Center(
                child: Text('Main Content'),
              ),
            ),
          ),
        ],
      ),
    );
  }
}