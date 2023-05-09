import './bootstrap';
import IMask from 'imask';

console.log("Hello from app.js");

var element = document.getElementById('phone');
var maskOptions = {
  mask: '+{7}(000)000-00-00'
};
var mask = IMask(element, maskOptions);