<h2>Project description<h2>
<p>I made this exercise as a test for a junior web developer position.</p>
<p>I had previous experience working with:</p>
  <ul>
    <li>HTML5</li>
    <li>CSS3</li>
    <li>JS</li>
  </ul>

<p>Before this project, I haven't worked with:</p>
  <ul>
    <li>PHP</li>
    <li>OOP</li>
    <li>MVC</li>
    <li>MySQL</li>
    <li>ajax</li>
    <li>jQuery</li>
    <li>icon fonts</li>
  </ul>

<p>What would I have done differently: used MVC pattern from the start for a cleaner code structure.
</p>

<h2>Setting up project</h2>

<p>To work with this project locally you have to have PHP and a local server.</p>
<p>In order to work with db you have to create a file called db_config.php in the config folder. I have created a sample file. Copy the example file, rename it, and replace the database credentials.</p>

<h3>Run the following queries in db</h3>

CREATE DATABASE `pineapple` /_!40100 DEFAULT CHARACTER SET utf8 _/

CREATE TABLE `subscriptions` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`email` varchar(100) NOT NULL,
`provider` varchar(50) NOT NULL,
`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `provider_index` (`provider`)
) ENGINE=MyISAM AUTO_INCREMENT=282 DEFAULT CHARSET=utf8
