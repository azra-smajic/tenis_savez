import 'package:flutter/material.dart';
import 'package:flutter_dotenv/flutter_dotenv.dart';
import 'package:flutter_localizations/flutter_localizations.dart';
import 'package:mobile_project/pages/HomePage.dart';
import 'package:mobile_project/pages/LoginPage.dart';
import 'package:mobile_project/pages/player/PlayerListPage.dart';
import 'package:mobile_project/providers/baseProviders/locale_provider.dart';
import 'package:provider/provider.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';

import 'l10n/l10n.dart';

void main() async {
  await dotenv.load(fileName: "assets/.env");
  runApp( MyApp());
}

class MyApp extends StatelessWidget {

  @override
  Widget build(BuildContext context) => ChangeNotifierProvider (
      create: (context) => LocaleProvider(),
      builder: (context, child) {
        final provider = Provider.of<LocaleProvider>(context);

        return MaterialApp(
          home: HomePage(),
          initialRoute: '/login',
          routes: {
            '/login':(context)=> LoginPage(),
            '/home':(context)=> HomePage(),
            '/playerList':(context)=> PlayerListPage(),
          },
          locale: provider.locale,
          supportedLocales: L10n.all,
          localizationsDelegates: [
            AppLocalizations.delegate,
            GlobalMaterialLocalizations.delegate,
            GlobalCupertinoLocalizations.delegate,
            GlobalWidgetsLocalizations.delegate,
          ],
        );
      }
  );
}

