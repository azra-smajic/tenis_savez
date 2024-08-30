// src/i18n.js
import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

// Import your translations
import enTranslations from './locales/en/translation.json';
//import bsTranslations from './locales/es/translation.json';

i18n
  .use(initReactI18next) // Pass the i18n instance to react-i18next
  .init({
    resources: {
      en: {
        translation: enTranslations
      },
    //   bs: {
    //     translation: bsTranslations
    //   }
    },
    lng: 'en', // Default language
    //fallbackLng: 'bs', // Fallback language if the selected language is not available
    interpolation: {
      escapeValue: false // React already does escaping
    }
  });

export default i18n;