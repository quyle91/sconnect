(()=>{var e,t={685:(e,t,r)=>{"use strict";r.r(t);var o=r(9307);const l=window.wp.blocks;var a=r(1984),c=r(444);const n=(0,o.createElement)(c.SVG,{xmlns:"http://www.w3.org/2000/SVG",viewBox:"0 0 24 24",fill:"none"},(0,o.createElement)("path",{stroke:"currentColor",strokeWidth:"1.5",fill:"none",d:"M6 3.75h12c.69 0 1.25.56 1.25 1.25v14c0 .69-.56 1.25-1.25 1.25H6c-.69 0-1.25-.56-1.25-1.25V5c0-.69.56-1.25 1.25-1.25z"}),(0,o.createElement)("path",{fill:"currentColor",fillRule:"evenodd",d:"M6.9 7.5A1.1 1.1 0 018 6.4h8a1.1 1.1 0 011.1 1.1v2a1.1 1.1 0 01-1.1 1.1H8a1.1 1.1 0 01-1.1-1.1v-2zm1.2.1v1.8h7.8V7.6H8.1z",clipRule:"evenodd"}),(0,o.createElement)("path",{fill:"currentColor",d:"M8.5 12h1v1h-1v-1zM8.5 14h1v1h-1v-1zM8.5 16h1v1h-1v-1zM11.5 12h1v1h-1v-1zM11.5 14h1v1h-1v-1zM11.5 16h1v1h-1v-1zM14.5 12h1v1h-1v-1zM14.5 14h1v1h-1v-1zM14.5 16h1v1h-1v-1z"})),i=JSON.parse('{"name":"woocommerce/order-confirmation-totals","version":"1.0.0","title":"Order Totals","description":"Display the items purchased and order totals.","category":"woocommerce","keywords":["WooCommerce"],"supports":{"multiple":false,"align":["wide","full"],"html":false,"typography":{"fontSize":true,"lineHeight":true,"__experimentalFontFamily":true,"__experimentalTextDecoration":true,"__experimentalFontStyle":true,"__experimentalFontWeight":true,"__experimentalLetterSpacing":true,"__experimentalTextTransform":true,"__experimentalDefaultControls":{"fontSize":true}},"color":{"background":true,"text":true,"link":true,"gradients":true,"__experimentalDefaultControls":{"background":true,"text":true}},"spacing":{"padding":true,"margin":true,"__experimentalDefaultControls":{"margin":false,"padding":false}},"__experimentalBorder":{"color":true,"style":true,"width":true,"__experimentalDefaultControls":{"color":true,"style":true,"width":true}},"__experimentalSelector":".wp-block-woocommerce-order-confirmation-totals table"},"attributes":{"align":{"type":"string","default":"wide"},"className":{"type":"string","default":""}},"textdomain":"woocommerce","apiVersion":2,"$schema":"https://schemas.wp.org/trunk/block.json"}'),s=window.wp.blockEditor,m=window.wp.components;var d=r(5736);const u=window.wc.priceFormat;r(3891);(0,l.registerBlockType)(i,{icon:{src:(0,o.createElement)(a.Z,{icon:n,className:"wc-block-editor-components-block-icon"})},attributes:{...i.attributes},edit:()=>{const e=(0,s.useBlockProps)({className:"wc-block-order-confirmation-totals"}),{borderBottomColor:t,borderLeftColor:r,borderRightColor:l,borderTopColor:a,borderWidth:c}=e.style,n={borderBottomColor:t,borderLeftColor:r,borderRightColor:l,borderTopColor:a,borderWidth:c};return(0,o.createElement)("div",{...e},(0,o.createElement)(m.Disabled,null,(0,o.createElement)("table",{style:n,cellSpacing:"0",className:"wc-block-order-confirmation-totals__table"},(0,o.createElement)("thead",null,(0,o.createElement)("tr",null,(0,o.createElement)("th",{className:"wc-block-order-confirmation-totals__product"},(0,d.__)("Product","woocommerce")),(0,o.createElement)("th",{className:"wc-block-order-confirmation-totals__total"},(0,d.__)("Total","woocommerce")))),(0,o.createElement)("tbody",null,(0,o.createElement)("tr",{className:"woocommerce-table__line-item order_item"},(0,o.createElement)("th",{scope:"row",className:"wc-block-order-confirmation-totals__product"},(0,o.createElement)("a",{href:"#link"},(0,d._x)("Test Product","sample product name","woocommerce"))," ",(0,o.createElement)("strong",{className:"product-quantity"},"× 2")),(0,o.createElement)("td",{className:"wc-block-order-confirmation-totals__total"},(0,u.formatPrice)(2e3))),(0,o.createElement)("tr",{className:"woocommerce-table__line-item order_item"},(0,o.createElement)("th",{scope:"row",className:"wc-block-order-confirmation-totals__product"},(0,o.createElement)("a",{href:"#link"},(0,d._x)("Test Product","sample product name","woocommerce"))," ",(0,o.createElement)("strong",{className:"product-quantity"},"× 2")),(0,o.createElement)("td",{className:"wc-block-order-confirmation-totals__total"},(0,u.formatPrice)(2e3)))),(0,o.createElement)("tfoot",null,(0,o.createElement)("tr",null,(0,o.createElement)("th",{className:"wc-block-order-confirmation-totals__label",scope:"row"},(0,d.__)("Total","woocommerce")),(0,o.createElement)("td",{className:"wc-block-order-confirmation-totals__total"},(0,u.formatPrice)(4e3)))))))},save:()=>null})},3891:()=>{},9307:e=>{"use strict";e.exports=window.wp.element},5736:e=>{"use strict";e.exports=window.wp.i18n},444:e=>{"use strict";e.exports=window.wp.primitives}},r={};function o(e){var l=r[e];if(void 0!==l)return l.exports;var a=r[e]={exports:{}};return t[e].call(a.exports,a,a.exports,o),a.exports}o.m=t,e=[],o.O=(t,r,l,a)=>{if(!r){var c=1/0;for(m=0;m<e.length;m++){for(var[r,l,a]=e[m],n=!0,i=0;i<r.length;i++)(!1&a||c>=a)&&Object.keys(o.O).every((e=>o.O[e](r[i])))?r.splice(i--,1):(n=!1,a<c&&(c=a));if(n){e.splice(m--,1);var s=l();void 0!==s&&(t=s)}}return t}a=a||0;for(var m=e.length;m>0&&e[m-1][2]>a;m--)e[m]=e[m-1];e[m]=[r,l,a]},o.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return o.d(t,{a:t}),t},o.d=(e,t)=>{for(var r in t)o.o(t,r)&&!o.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),o.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.j=9571,(()=>{var e={9571:0};o.O.j=t=>0===e[t];var t=(t,r)=>{var l,a,[c,n,i]=r,s=0;if(c.some((t=>0!==e[t]))){for(l in n)o.o(n,l)&&(o.m[l]=n[l]);if(i)var m=i(o)}for(t&&t(r);s<c.length;s++)a=c[s],o.o(e,a)&&e[a]&&e[a][0](),e[a]=0;return o.O(m)},r=self.webpackChunkwebpackWcBlocksJsonp=self.webpackChunkwebpackWcBlocksJsonp||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))})();var l=o.O(void 0,[2869],(()=>o(685)));l=o.O(l),((this.wc=this.wc||{}).blocks=this.wc.blocks||{})["order-confirmation-totals"]=l})();