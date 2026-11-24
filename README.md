# Dr Alex Rivera – one-page site

A custom Gutenberg block theme (`rivera/`) for a fictional clinical psychologist. No plugins, no build step and no front-end JavaScript of its own.

## Running it

**With wp-env** (needs Docker and Node):

```sh
npx @wordpress/env start
```

Then open http://localhost:8888. The theme is activated for you.

**On any WordPress 6.6+ install:** copy `rivera/` into `wp-content/themes/`, activate it under Appearance → Themes, and set Settings → General → Site Language to English (Australia) so the page is marked up as `en-AU`.

The home page works whether WordPress shows latest posts or a static page, because the theme provides a `front-page.html` template.

## How it's put together

```
rivera/
├── style.css           Theme header plus the few styles theme.json can't express
├── theme.json          Colours, type scale, spacing, layout and block styles
├── functions.php       Loads the stylesheet and the files in inc/
├── inc/
│   ├── profile.php     Her details and courses: the content for the whole page
│   ├── seo.php         Page title, meta description, canonical and Open Graph tags
│   └── schema.php      JSON-LD for the WebSite, ProfilePage, Person and Courses
├── templates/          front-page, page, index and 404
├── parts/              header and footer
├── patterns/           One pattern per section: hero, about, courses, contact
└── assets/images/      The portrait
```

**One source of truth.** The page sections and the JSON-LD both read from `rivera_get_profile()` in `inc/profile.php`. Changing a course there changes the card and its structured data together, so the two can't drift apart. The `rivera_profile` filter lets a child theme or plugin change the data without touching the theme. That's how the placeholder `#` course links would be swapped for real ones.

**Everything renders on the server.** The sections are PHP block patterns that output ordinary core blocks (group, heading, paragraph, image, buttons, navigation). WordPress renders them into the HTML on the server. Nothing needs JavaScript to appear, and the navigation is set to never collapse, so core doesn't load its menu script.

**Still editable.** The patterns are plain core block markup, so the page opens cleanly in the Site Editor. Every block on the page passes the editor's validation.

## SEO and AEO

- Title: `Dr Alex Rivera – Clinical Psychologist and Trainer`
- Meta description, canonical link and Open Graph tags on the home page
- One `h1`, then `h2` for each section and `h3` for each course
- JSON-LD `@graph` with:
  - `Person`: name, honorific, job title, bio, email, Sydney address, photo, `knowsAbout`
  - one `Course` per course, with Dr Rivera as `provider`, and a `CourseInstance` giving the online mode and the workload as an ISO 8601 duration (`PT6H`, `PT4H`, and a monthly `Schedule` for supervision)
  - `ProfilePage` and `WebSite` nodes linking them together by `@id`
- Each course card's `id` matches its `Course` `@id` fragment, so the data points at the visible content.
- A course `url` is only output once a real link replaces the `#` placeholder.
- If Yoast, Rank Math, AIOSEO or SEOPress is switched on, the theme's head tags step aside so nothing is printed twice. The JSON-LD stays, because it describes the page content rather than general SEO settings.

## Accessibility

- Landmarks: `header`, `nav` (labelled "Main"), `main`, a `section` for each part of the page, an `article` for each course, and `footer`
- Core's skip link goes to `main`
- A visible 3px focus outline on every link and button
- "Find out more" links include the course name for screen readers, e.g. "Find out more about Acceptance and Commitment Therapy for Anxiety"
- Alt text on the portrait
- Text contrast is AA or better throughout
- Smooth scrolling only when the visitor hasn't asked for reduced motion

## Performance

- One self-hosted font file: Montserrat, cut down to Latin characters and the 400–700 weights (51 KB woff2, `font-display: swap`). It loads from the site itself, with no Google Fonts request.
- The portrait gets `width`, `height` and `fetchpriority="high"`. Core only adds these to media library images, so `functions.php` adds them to the theme's image.
- The front-end emoji script is removed

## Checks before sending

| Check | Result |
| --- | --- |
| PHP_CodeSniffer, WordPress standard (`composer lint`) | No errors or warnings |
| axe-core (WCAG 2.2 AA and best practice), desktop and 375px | No violations |
| html-validate on the rendered page | Valid |
| Lighthouse | Performance 99, Accessibility 100, Best Practices 100, SEO 100 |
| Keyboard only | Skip link, name, nav, hero buttons, course links, email, footer name: all reachable, in order, focus always visible |
| JavaScript disabled | All content and headings present |
| 375px viewport | Single column, no horizontal scrolling |
| Site Editor | Front page template loads; all 49 blocks valid |
| JSON-LD | Parses; matches the visible content |

**Fixed along the way.** I'd first named a palette colour `border`. WordPress turns that into a `.has-border-color` utility class, which clashes with the class core adds to any block with a custom border. The course card text was being painted in the light border colour. axe caught it as a contrast failure, and renaming the colour to `line` fixed it.

## Credits

- Montserrat by Julieta Ulanovsky and contributors, under the SIL Open Font License (`rivera/assets/fonts/OFL.txt`).
- The portrait is a stock photo. Swap `rivera/assets/images/alex-rivera.jpg` and the alt text in `inc/profile.php` to change it.
