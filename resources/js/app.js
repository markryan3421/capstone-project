import './bootstrap';
import 'preline';
import Settings from './settings';

if(document.querySelector("settings-button")) {
  new Settings();
}
