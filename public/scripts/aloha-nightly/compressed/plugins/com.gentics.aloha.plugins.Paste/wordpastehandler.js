GENTICS.Aloha.PastePlugin.WordPasteHandler=new GENTICS.Aloha.PastePlugin.PasteHandler;GENTICS.Aloha.PastePlugin.WordPasteHandler.handlePaste=function(a){this.detectWordContent(a)&&this.transformWordContent(a)};
GENTICS.Aloha.PastePlugin.WordPasteHandler.detectWordContent=function(a){var d=false;a.find("*").each(function(){var c=jQuery(this).attr("style");if(c)if(c.toLowerCase().indexOf("mso")>=0){d=true;return false}if(c=jQuery(this).attr("class"))if(c.toLowerCase().indexOf("mso")>=0){d=true;return false}});return d};
GENTICS.Aloha.PastePlugin.WordPasteHandler.isOrderedList=function(a){if(a.css("fontFamily")=="Wingdings"||a.css("fontFamily")=="Symbol")return false;return a.text().match(/^([0-9]{1,3}\.)|([0-9]{1,3}\)|([a-zA-Z]{1,5}\.)|([a-zA-Z]{1,5}\)))$/)?true:false};
GENTICS.Aloha.PastePlugin.WordPasteHandler.transformListsFromWord=function(a){var d=this,c="p.MsoListParagraphCxSpFirst,p.MsoListParagraph,p span";c=a.find(c);c.each(function(){var b=jQuery(this);if(b.hasClass("MsoListParagraphCxSpFirst")||b.hasClass("MsoListParagraph"))b.addClass("aloha-list-element");else if(b.css("font-family").indexOf("Symbol")>=0)b.closest("p").addClass("aloha-list-element");else b.css("mso-list")!=""&&b.closest("p").addClass("aloha-list-element")});c="p span span span";a.find(c).each(function(){var b=
jQuery(this);if(b.text().trim().replace(/&nbsp;/g,"").length==0)if(b.parent().parent().text().trim().replace(/&nbsp;/g,"").match(/^([0-9]{1,3}\.)|([0-9]{1,3}\)|([a-zA-Z]{1,5}\.)|([a-zA-Z]{1,5}\)))$/)){b.closest("p").addClass("aloha-list-element");b.parent().parent().addClass("aloha-list-bullet")}});c="p.aloha-list-element";var o=":not("+c+")";c=a.find(c);c.length>0&&c.each(function(){var b=jQuery(this);b.removeClass("aloha-list-element");b.find("font").each(function(){jQuery(this).contents().unwrap()});
var i=0,j=parseFloat(b.css("marginLeft")),k=[],p=b.nextUntil(o),e=jQuery(b.find("span.aloha-list-bullet"));if(e.length==0)e=jQuery(b.children("span:first"));var m=d.isOrderedList(e);e.remove();var f=jQuery(m?"<ol></ol>":"<ul></ul>");k.push(f);var h=jQuery("<li></li>");f.append(h);b.contents().appendTo(h);b.replaceWith(f);p.each(function(){var g=jQuery(this);g.find("font").each(function(){jQuery(this).contents().unwrap()});var l=parseFloat(g.css("marginLeft"));e=jQuery(g.find("span.aloha-list-bullet"));
if(e.length==0)e=jQuery(g.children("span:first"));m=d.isOrderedList(e);e.remove();if(l>j){var n=jQuery(m?"<ol></ol>":"<ul></ul>");f.children(":last").append(n);f=n;k.push(f);i++;j=l}else if(l<j&&i>0){k.pop();i--;f=k[i];j=l}h=jQuery("<li></li>");f.append(h);g.contents().appendTo(h);g.remove()})})};
GENTICS.Aloha.PastePlugin.WordPasteHandler.transformTitles=function(a){a.find("p.MsoTitle").each(function(){GENTICS.Aloha.Markup.transformDomObject(jQuery(this),"h1")});a.find("p.MsoSubtitle").each(function(){GENTICS.Aloha.Markup.transformDomObject(jQuery(this),"h2")})};GENTICS.Aloha.PastePlugin.WordPasteHandler.transformTables=function(a){a.find("table").each(function(){jQuery(this).removeAttr("border").removeAttr("cellspacing").removeAttr("cellpadding")});a.find("td").each(function(){jQuery(this).removeAttr("width").removeAttr("height").removeAttr("valign")})};
GENTICS.Aloha.PastePlugin.WordPasteHandler.transformFormattings=function(a){a.find("strong,em,s,u").each(function(){if(this.nodeName.toLowerCase()=="strong")GENTICS.Aloha.Markup.transformDomObject(jQuery(this),"b");else if(this.nodeName.toLowerCase()=="em")GENTICS.Aloha.Markup.transformDomObject(jQuery(this),"i");else if(this.nodeName.toLowerCase()=="s")GENTICS.Aloha.Markup.transformDomObject(jQuery(this),"del");else this.nodeName.toLowerCase()=="u"&&jQuery(this).contents().unwrap()})};
GENTICS.Aloha.PastePlugin.WordPasteHandler.removeComments=function(a){a.contents().each(function(){this.nodeType==8&&jQuery(this).remove()})};GENTICS.Aloha.PastePlugin.WordPasteHandler.unwrapTags=function(a){a.find("span,font,div").each(function(){jQuery(this).contents().unwrap()})};GENTICS.Aloha.PastePlugin.WordPasteHandler.removeStyles=function(a){a.find("*").each(function(){jQuery(this).removeAttr("style").removeClass()})};
GENTICS.Aloha.PastePlugin.WordPasteHandler.removeNamespacedElements=function(a){a.find("*").each(function(){var d=this.prefix?this.prefix:this.scopeName?this.scopeName:undefined;d&&d!="HTML"&&jQuery(this).remove()})};GENTICS.Aloha.PastePlugin.WordPasteHandler.transformWordContent=function(a){this.transformListsFromWord(a);this.transformTables(a);this.transformTitles(a);this.removeComments(a);this.unwrapTags(a);this.removeStyles(a);this.removeNamespacedElements(a);this.transformFormattings(a)};