$('#side-menu').toc({
    'selectors': 'h2', //elements to use as headings
    'container': 'body', //element to find all selectors in
    'smoothScrolling': true, //enable or disable smooth scrolling on click
    'prefix': '', //prefix for anchor tags and class names
    'highlightOnScroll': true, //add class to heading that is currently in focus
    'anchorName': function(i, heading, prefix) { //custom function for anchor name
        return prefix+i;
    },
    'headerText': function(i, heading, $heading) { //custom function building the header-item text
console.log($heading);
        return $heading.text();
    },
    'itemClass': function(i, heading, $heading, prefix) { // custom function for item class
      return "";
    },
    'listType':"<ul class='nav nav-pills nav-stacked' />",
    'activeClass': "active"
});