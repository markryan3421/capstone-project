import './bootstrap';
import Settings from './settings';
import Homepage from './homepage';

if(document.querySelector("settings-button")) {
  new Settings();
}

Homepage();
