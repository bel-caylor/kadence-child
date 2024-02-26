/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./js/script-editor.js":
/*!*****************************!*\
  !*** ./js/script-editor.js ***!
  \*****************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
eval("__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _sermonBlank__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./sermonBlank */ \"./js/sermonBlank.js\");\n/* harmony import */ var _sermonBlank__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_sermonBlank__WEBPACK_IMPORTED_MODULE_0__);\n\n\n//# sourceURL=webpack://kadence-child/./js/script-editor.js?");

/***/ }),

/***/ "./js/sermonBlank.js":
/*!***************************!*\
  !*** ./js/sermonBlank.js ***!
  \***************************/
/***/ (() => {

eval("var addFilter = wp.hooks.addFilter;\nvar _wp$blockEditor = wp.blockEditor,\n  BlockControls = _wp$blockEditor.BlockControls,\n  RichTextToolbarButton = _wp$blockEditor.RichTextToolbarButton;\n// const { ToolbarButton } = wp.components;\n\n//Registor Custom Format\nwp.richText.registerFormatType('my-custom-format/sermon-blank', {\n  title: 'Sermon Blank',\n  tagName: 'span',\n  className: 'sermon-blank'\n});\nvar CustomButton = function CustomButton(BlockEdit) {\n  return function (props) {\n    // Only add the button to the paragraph block\n    if (props.name !== 'core/paragraph' && props.name !== 'core/list-item') {\n      return /*#__PURE__*/React.createElement(BlockEdit, props);\n    }\n    return /*#__PURE__*/React.createElement(React.Fragment, null, /*#__PURE__*/React.createElement(BlockControls, null, /*#__PURE__*/React.createElement(RichTextToolbarButton, {\n      icon: \"button\",\n      title: \"A Sermon Blank\",\n      priority: 5,\n      onClick: function onClick() {\n        var _wp$richText = wp.richText,\n          replace = _wp$richText.replace,\n          insert = _wp$richText.insert,\n          create = _wp$richText.create,\n          toHTMLString = _wp$richText.toHTMLString,\n          slice = _wp$richText.slice,\n          applyFormat = _wp$richText.applyFormat;\n        var _wp$data$select = wp.data.select('core/block-editor'),\n          getSelectedBlock = _wp$data$select.getSelectedBlock;\n        var selectedBlock = getSelectedBlock();\n        console.log(selectedBlock);\n        if (selectedBlock && selectedBlock.attributes.content) {\n          var start = wp.data.select('core/block-editor').getSelectionStart();\n          var end = wp.data.select('core/block-editor').getSelectionEnd();\n          start = start.offset;\n          end = end.offset;\n          var richTextValue = create({\n            html: selectedBlock.attributes.content\n          });\n\n          // Apply the format to the selected text\n          var modifiedValue = applyFormat(richTextValue, {\n            type: 'my-custom-format/sermon-blank'\n          }, start, end);\n\n          // Convert the modified value back to HTML\n          var modifiedContent = toHTMLString({\n            value: modifiedValue\n          });\n\n          // Update the block's content\n          wp.data.dispatch('core/block-editor').updateBlockAttributes(selectedBlock.clientId, {\n            content: modifiedContent\n          });\n        }\n      }\n    })), /*#__PURE__*/React.createElement(BlockEdit, props));\n  };\n};\naddFilter('editor.BlockEdit', 'your-namespace', CustomButton);\n\n//# sourceURL=webpack://kadence-child/./js/sermonBlank.js?");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval devtool is used.
/******/ 	var __webpack_exports__ = __webpack_require__("./js/script-editor.js");
/******/ 	
/******/ })()
;