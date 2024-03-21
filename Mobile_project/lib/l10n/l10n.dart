import 'package:flutter/material.dart';

class L10n {
  static final all = [
    const Locale('bs'),
    const Locale('hr'),
    const Locale('en'),
  ];

  static String getFlag(String code) {
    switch (code) {
      case 'bs':
        return '🇧🇦';
      case 'hr':
        return '🇭🇷';
      case 'en':
      default:
        return '🇺🇸';
    }
  }

  static String getName(String code){
    switch (code) {
      case 'bs':
        return 'Bosanski';
      case 'hr':
        return 'Hrvatski';
      case 'en':
      default:
        return 'English';
    }
  }
}