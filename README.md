<h2>PHP XML Parser</h2>
<p>A PHP XML parser script that provides an easy way to convert XML into native PHP arrays. It has no dependencies on any external libraries or extensions bundled with PHP. The entire parser is concisely written in PHP.</p>
<p>This project is actively maintained. If you spot an issue, please let me know through the Issues section on our Github project page: <a href="https://github.com/tursander/XML-Parser-in-PHP/issues">https://github.com/tursander/XML-Parser-in-PHP/issues</a></p>

<h2>Why</h2>
<p>As XML becomes less popular, the need for a parser moves from constant to infrequent. It makes little sense to keep a parser resident in memory at all times for functionality that might be used once every few days.
<p>For example, just to get SimpleXML going, you will need to have the libxml2 library installed on your system. You will need xml, libxml, and simplexml extensions installed for PHP. You will need to keep all those extensions in memory for each request.</p>
<p>In contrast, this simple parser is less than 500 lines of code and is only loaded when you need it. It has no dependencies, no required libraries or extensions, and will work on any modern PHP installation. The price you pay for that convenience is speed. It is much slower than SimpleXML. See the benchmarking section for details.</p>
<p>In short, this project makes sense for those who want to simplify their PHP install and use, have a need for a simple XML parser, but don't much care about speed.</p>

<h2>Requirements</h2>
<p>PHP 5.4.0+</p>

<h2>Install</h2>
<p>Just place the <em>countries.xml</em> and <em>index.php</em> files in a convenient location.</p>

<h2>Tests</h2>
<p>None, for now.</p>

<h2>Authors</h2>
<ul>
<li>Cezar Bumbaru - <em>Initial work</em> - <a href="https://github.com/tursander" target=_blank">tursander</a>
</ul>
<p>See also the list of <a href="https://github.com/your/project/contributors" target=_blank">contributors</a> who participated in all these projects.

<h2>License</h2>
<p>This project is licensed under the MIT License - see the <a href="LICENSE.md" target=_blank">LICENSE.md</a> file for details.
