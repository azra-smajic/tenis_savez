import 'package:flutter/cupertino.dart';
import 'package:flutter/material.dart';
import 'package:mobile_project/models/base_search_dto.dart';
import 'package:mobile_project/providers/player_provider.dart';

import '../../models/user_dto.dart';
import '../SideBar.dart';

class PlayerListPage extends StatefulWidget{
  @override
  _PlayerListPageState createState() => _PlayerListPageState();
}

class _PlayerListPageState extends State<PlayerListPage>{
  final PlayerProvider _playerProvider = PlayerProvider();
  List<UserDto> _players = [];
  BaseSearchDto _searchObject = BaseSearchDto();

  @override
  void initState(){
    fetchPlayers();
  }

  Future<void> fetchPlayers() async{
    var data = await _playerProvider.get(_searchObject.pageNumber, _searchObject.pageSize);

    setState(() {
      _players = data;
    });
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
                child: DataTable(
                  columns: [
                    DataColumn(label: Text('Ime i prezime')),
                    DataColumn(label: Text('E-mail')),
                    DataColumn(label: Text('Godina rođenja')),
                    DataColumn(label: Text('Broj telefona')),
                  ],
                  rows: _players
                      .map(
                        (player) => DataRow(
                      cells: [
                        DataCell(Text("${player.first_name} ${player.last_name}")),
                        DataCell(Text(player.email)),
                        DataCell(Text(player.birth_year)),
                        DataCell(Text(player.phone_number)),
                      ],
                    ),
                  ).toList(),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}