import './bootstrap';
import 'preline';
import Settings from './settings';
import './notification';

if(document.querySelector("settings-button")) {
  new Settings();
}
