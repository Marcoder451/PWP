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
