<h1>Portfolio</h1>
<div id="message" class="updated below-h2"><p><b>Important!</b> To create portfolios, you need to have the veuse-portfolio plugin installed and activated. This plugin is automatically installed and activated on theme activation. </p></div>

<?php if(class_exists('VeusePortfolio')):?>
<?php else:?>
<div id="message" class="error below-h2">

	<p><b>Important!</b></p>
	<p>The veuse-portfolio plugin is not installed and/or activated.</p>

	<p> Before you can create a portfolio, you need to install and activate the plugin. This plugin is automatically installed and activated on theme activation. If you have deactivated it, I suggest you to go your plugins page an reactivate it.</p>
	<p>
	The veuse-portfolio plugin is licenced as GPL, and can be found at github: <a href="https://github.com/veuse/veuse-portfolio">https://github.com/veuse/veuse-portfolio</a>
	</p>
</div>

<?php endif;?>

<h2>Working with portfolios</h2>
<p>Creating a portfolio is much like creating a blog. With Veuse Portfolio,  the posts are called projects, and the categories are called Portfolios. In short, projects are organized in portfolios, just like posts are organized in categories.
<hr>

		<h3>Create categories</h3>
		<p>
		Portfolio-posts are called <b>Projects</b>, and are organized in categories called portfolios. 
		
		<ol>
			<li>Go to Portfolio &raquo; Portfolios. Under <i>Add New Portfolio</i>.</li>
			<li>Enter a name for your portfolio and click on the button <b>Add New Portfolio</b></li>
		</ol>
	
<hr>
<h3>Create a project to go in your portfolio</h3>
		<ol>
			<li>Go to Portfolio &raquo; Add New Project. This creates a new project. </li>
			<li>Give the project a title and add content in the editor.</li>
			<li>Give the project a featured image. This is what will be displayed in the portfolio grid view.</li>
			<li>Add a category/portfolio to the project.</li>
			<li>There is a meta-panel on the page called 'Project Meta', where you can enter some extra data for the project. Enter the data you want.</br>
				
					<ul class="inline-list">
						<li><b>The Project Meta fields:</b></li>
						<li>Project website</li>
						<li>Client - Name of client</li>
						<li>Launch - Time of launch</li>
						<li>Credits</li>
					</ul>
			</li>
		</ol>


<hr>

<h3>Post formats</h3>
		
<p>The projects support Wordpress post-formats for Image, Gallery and Video. This means you can change the content of your project based on which post format you select for your project.</p>


<h4>Image format</h4>
<p>If you select the image format, the post will display the featured image</p>


<h4>Video format</h4>
<p>If you select the video format, the post will display a "featured" video, that is added via the Featured Video meta-panel.</p>


<h4>Gallery format</h4>
<p>If you select the gallery format, the post will display a gallery or slideshow, with images added via the Image gallery meta panel.</p>

