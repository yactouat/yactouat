---
excerpt: Alright, I'm tired to the bugs linked to my previous deployments (mainly the unsubscribe link not working on prod); although the reasons why a query param has the value of 'amp;signature' on localhost and 'signature' on prod are probably fascinating, I do want to tackle the next feature on day 3, or at least plan about it => `admin should be able to send mail campaigns on a schedule or on the spot`
tags: [software-development, ticket-stuff-out]
thumbnail_img: getting_into_the_newsletter_game.png
title: getting into the newsletter game
---

Day 3 post blog post launch: I've supposedly solved the bug with the unsubscribe link, and my level of confidence is high enough to let me check this when the post has been published on receiving an email in my inbox. I've fixed quite a few broken things in the styling and now reading a post is a much more pleasant experience. 

Now that I've done my duty for tonight, I'd like to think about the next big feature. Since the whole point of this very application is to communicate with the World, let's start simple: the admin should be able to send mail campaigns on a schedule or on the spot.

How should I go about this task? The rough steps I have in mind, are:

- create an admin route that leads to a dashboard view; I don't want to use a pre built overkill dashboard, so what I'm thinking is to have a simple page with a main panel on the right and an aside nav bar on the left that would help navigate between the different views of the dashboard
- what should the dashboard view for an email campaign look like? ... ok I'm stuck, I don't even know the components of an email campaign, so let's start there.

## What are the components of an email campaign?

From a business logic perspective, an email campaign should have:

- a name that identifies it and reflects its purpose for the admin
- a target audience
- a test email option, to check that everything goes well before sending the campaign to the target audience
- a unique mobile-friendly graphical identity, this would mean reviewing the existing graphical identity of the current email templates and also of the blog itself
- scheduling options, in order to choose between sending the email campaign on the spot or at a given date and time
- the email body, it should summarize the latest content of the blog and its latest news, as well as some personal thoughts from the owner of the blog
- the email subject, it should be catchy and short
- tracking: who opens the email, who clicks on the links, who unsubscribes, etc., the data should be then persisted and easily accessible to the admin

All of this should be **AI-auto generatable** if the admin doesn't want to spend time on it, but should be editable if the admin wants to customize it.

I think this is rather a complex feature, so I'll first it extract from [the default catch-all issue](https://github.com/yactouat/yactouat/issues/26) to put it [here](https://github.com/yactouat/yactouat/issues/27).

And yeah, about that catch-all issue, I'm not sure it's a good idea to have it, so let's rename it to `minimal viable product`: the idea here is to have a blog that respects minimal standards after the first launch iteration, and to keep only that in this card. Let's ticket this out! a job well planned is a job half done. Let's clean up the mess of dozens of ideas poorly distributed and written.

After I've tidied up all the issues of my project, I'm left with these issues in progress, that I will have to finish in priority:

### [a minimum viable product should be deployed](https://github.com/yactouat/yactouat/issues/26)

### admin should have a systems status view at his dispoal

What I mean by _systems_ is db, cache, etc.

### app' should be constantly refactored and improved

This is the new catch-all ticket, but this time I tried to make it more relevant by adding only tasks that are not features, but are required at some point to improve the quality of the codebase, the user experience, the infrastructure, etc.

Here are its items =>

- [ ] a maintenance mode should exist
- [ ] a selective caching strategy should be implemented
- [ ] a confirmation modal should appear on account deletion
- [ ] add a search icon next to the search bar
- [ ] decide what to do with `remember_token`
- [ ] each tag should have its own color
- [ ] Google Cloud implemented APIs should be fully integrated
- [ ] Google Cloud project recommendations review
- [ ] images should be automatically optimized
- [ ] it should queue or schedule seeding posts
- [ ] it should queue emails
- [ ] loading indicators where relevant
- [ ] next Laravel/Tailwind/Alpine learning steps/implementation (Laracasts/Laravel documentation)
- [ ] old Artifactory images and Cloud Run images should be automatically cleaned
- [ ] redirections on logging in/out
- [ ] security review
- [ ] SendGrid API should be fully implemented
- [ ] understand why too many signed routes are persisted
- [ ] telemetry implementation
- [ ] test seeding when file is renamed
- [ ] test seeding when thumbnail image does not exist
- [ ] users should be invited to verify their email
- [ ] ... and more to come

### GitHub should be fully integrated with the application

Initially, this project was a simple Readme project, but I've decided to make it a full blown blog, so I need to integrate GitHub with it. It's about time I learn all about the GitHub platform in depth, I'm quite excited about this one!

### Google's Search Console should be fully integrated and a SEO audit should be conducted

What's the point of running a blog if nobody reads it right? I need to learn all about SEO and how to optimize my blog for search engines. I'm quite excited about this one too!

Yay, it's tickets time, I love this phase and this time I deserve it because I shipped code today 😉

Cheers,