# php

## Milestone 1 Feedabck
I'm really looking forward to seeing this project take shape - this is a great idea for PWP. In all likelihood, ANC's website needs will be beyond the scope of PWP in the future, but you can put together a very nice MVP based on your purpose and goals outlined here.

Your purpose, audience, goal, Persona and Use Case are all good - and your HTML is looking good overall as well. There are a couple of technical issues I want to bring to your attention, please see **Edits &amp; Suggestions** below.

Your Milestone 1 passes at [Tier III](https://bootcamp-coders.cnm.edu/projects/personal/rubric/) - nice job. You're clear to begin work on [Milestone 2&alpha;](https://bootcamp-coders.cnm.edu/projects/personal/milestone-two/).

### Edits &amp; Suggestions
- line 1 in your `.gitignore` should be `.DS_Store`
- move your `/css` directory and `index.php` file inside `/public_html` - or delete them until you're ready to begin development after Milestone 2a.
- Looks like all the page content is in the &lt;header&gt; tag! **Quick fix**: Move the closing `</header>` tag up from line 66 to line 10, and you're good to go.
- Keep a close eye on your indentation - the &lt;p&gt; tags are indented one level too deep. Very minor point - but just keep your eye on it. 

## Milestone 2&alpha; Feedback

You definitely put a lot of thought into the wireframes for ANC. I can tell it's going to be an awesome company website.

According to [W3 Validator](https://validator.w3.org/nu/?doc=https%3A%2F%2Fbootcamp-coders.cnm.edu%2F~mlester3%2Fpwp%2Fpublic_html%2Fdocumentation%2Fmilestone-2.php) you have no warnings or errors, which is awesome! However, I did notice that you left out an important piece of the HTML puzzle, which is: `<meta name="viewport" content="width=device-width, initial-scale=1">`. That `<meta>` tag is important for responsive development.

Your html, overall, looks great, but the way that you've put everything into the `<header>` tag and encapsulated your content within a `<nav>` tag should be updated. I would recommend keeping your `<h1>` tag within the `<header>` tag and putting the rest of your content, from the `<h3>` tag and down into a `<main>` tag. Once you've done that you can get rid of the `<nav>` opening and closing tags.

I also noticed that there are a few inconsistencies within your mobile and desktop wireframes. 

Some of the mobile wireframes feature what looks to be a carousel for images (am I correct in assuming it's a carousel?), which is great, but some of them have what appears to be writing over the carousel, whereas the last wireframe does not. Is this intentional?

Regarding the desktop wireframes there are differences in the location of the nav links. Having one location for nav links is essential for UI/UX. As with the mobile wireframes the desktop wireframes seem to have some writing over the carousel in some of them, but not in others. Is this intentional?

The mobile wireframes also include a horizontal navbar, which is not recommended. When it comes to mobile development you really have no way of knowing the specific width of the device being used, which is why we recommend using a default bootstrap navbar that will change from horizontal to nav button at XS screen sizes. 

The consistency between your mobile and desktop wireframes as far as content layout is excellent, however, it is recommended to use full width text and images when developing for mobile. Full width blocks of text and images make a better user experience in terms of sizing of images and readability of text. If you cram more than one column of text into a row it won't translate well on mobile.

Your breakdown of your content looks excellent for this use case. One thing to consider is the enormous scope of what you're proposing to do for this PWP. This is definitely doable from week 11 and onward, however, I think it would be beneficial for your stress levels and sanity if you cut the News section out of the scope during bootcamp. 

One thing that Rochelle brought up was the idea of transferring this to a WordPress or Drupal CMS after bootcamp to cut down on manually editing static pages for the News section of your site. It would help you better organize and handle the amount of pages you'll be creating for your News section.

Your content strategy looks great, and I'm looking forward to seeing how everything comes together! 

grade Tier III - Great job! https://bootcamp-coders.cnm.edu/projects/personal/rubric/

## Milestone 2&beta; Feedback
Tier II.

## Milestone 3 / Final PWP Evaluation
I see that you've done some work after the due date, so I have to base your PWP  evaluation on your repository at the last commit before 12:00 on 6/7/17. https://github.com/Marcoder451/pwp/tree/6424a65b97ae1cc0dbfb5364f4699ca8311f7a0b/public_html

You've got a good start here - continue to work with Bootstrap, HTML and CSS to refine this layout for a professional look and feel. Your contact form appears to be wired correctly and functioning on my end - nice work. Check your email and see if you got my test message.

There are some issues with your CSS that are preventing your layout from working on mobile. This has to do with the way the page title is sized in your CSS, and it's also causing your navbar toggle button to get pushed way off to the side. See **Edits &amp; Suggestions** below for some technical fixes.

As I'm going through the site, I think that having the text content hidden might not be a good thing... it's not obvious to me as a user that I need to click on the images to read more, and I'm probably just going to scroll past all the info. I'd probably make that text visible - and you have great content too! Definitely worth showing. Just a thought.

Some simplification and minor adjustments to the Bootstrap grid will help your content sections line up nicely with each other. Definitely simplification... there's a bit too much going on with the grid classes, and making things simpler will make things both easier on you and your layout look better. This will give your site a professional polish. Use any of my demo projects as a guide.

You've challenged yourself with the jQuery driven collapse sections and that's great. Continue to practice and create mini projects, and build up in complexity as you go. You've got a good start - keep going.

Your Milestone 3/Final Delivery for PWP passes at [Tier II](https://bootcamp-coders.cnm.edu/projects/personal/rubric/).

Your overall passing grade across all of your PWP Milestones is [24/40 points (60%)](https://bootcamp-coders.cnm.edu/projects/personal/rubric/#sample-score).

- Milestone 1 - 20%: Tier III 30(0.2) = 6
- Milestone 2a - 20%: Tier III 30(0.2) = 6
- Milestone 2b - 10%: Tier II 20(0.1) = 2
- Milestone 3 - 50%: Tier  II 20(0.5) = 10

### Edits &amp; Suggestions
- Your welcome message isn't at all responsive on mobile. The size is set too big on your title in CSS, and putting it in a div with the class `carousel-caption` isn't the right way to do this. Have a look at some of my demo projects for a better way to build stuff like this. https://bootcamp-coders.cnm.edu/~rlewis37/
- I'd apply a background-image to the welcome section using CSS instead of using an `<img>` tag. This way, you can put your page title text inside the div, on top of the image. Like this:
#### HTML:
```
<div id="header">
	<div class="bg">
		<h1 class="brand-heading">Ambassadors N’ Chains</h1>
		<div class="row">
			<p class="lead">ANC has a wide range of services geared towards helping you to effectively</p>
			<p class="lead">get your message out to the world. Let's build your vision</p>
		</div>
	</div>
</div>
```
#### CSS: 
```
.bg {
	background-image: url("images/station.jpg") no-repeat center;
	background-size: cover;
}
```
- Try sizing your page title for large screens inside a `@media` query, and leave the default style for mobile. That CSS might look something like this:
```
@media only screen and (min-width: 992px) {
	h1.brand-heading {
	   color: steelblue;
	   font-size: 100px;
  }
}

```
- Because the welcome message area isn't responsive - your nav isn't visible on mobile either. Fix the welcome area, and the navbar should fall into place.
- `cm` (centimeters) are one of the units of measurement that aren't appropriate for the web. Use px, rem, em, vh, vw, or % instead.
- Avoid nesting Bootstrap `container`s inside each other. This kind of messes up the grid a little. See lines 99 and 101.
- Update the `alt` attributes on your images. This is good for SEO, especially for your artists! Google Image search uses the alt text.
- Remember that you can't repeat `id`s on a page. See lines 107 and 108.
