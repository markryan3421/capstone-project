import './bootstrap';
import 'preline';
import Settings from './settings';
import { Dropzone } from "dropzone";
const dropzone = new Dropzone("div#myId", { url: "/file/post" });

if(document.querySelector("settings-button")) {
  new Settings();
}
