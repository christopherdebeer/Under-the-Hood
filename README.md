Under the Hood
================

This is a re-skinnable mobile website package/framework, based on a project called "Under the Hood", that I built for [Line](http://lline.uk.com) &amp; [The Edinburgh International Science Festival](http://www.sciencefestival.co.uk/). To easily create simple yet well thought out mobile websites, that are skinable/customisable through the use of CSS and HTML alone, all the JavaScript/jQuery etc is handled by the framework.


How to use
------------

- Create your content.html pages in /app/pages/. Using only the semantic content of the page, ie: `<h2>` &amp; `<p>` etc.

- Based of the filenames of your pages, UndertheHood will create the rest of the site for you.

- You can edit a header.html &amp; footer.html in /app/ to customise either the &lt;head&gt; of your website or the footer of the site.


Graceful fallback:
	This framework while it works using jquery to load content using ajax, does fall back gracefully when javascript is disabled.
