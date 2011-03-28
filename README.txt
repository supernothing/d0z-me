ABOUT d0z.me
=========================
d0z.me is a demonstration of browser based DDoS techniques combined with URL
shortener hijacking. Basically, the concept is to trick large numbers of users
into viewing some page through an iframe, and then running code in the
background that tries to DDoS a target site.

RELEASE NOTES
=========================
This is still alpha software. No, seriously. I'm not talking Google's "oh, this might
break once or twice if you use it for years." No, I mean seriously alpha, as in
the bugs you will encounter will probably make you hate me with a passion that burns...
like wood...on fire. If it somehow rm -rf / 's your system, I am not responsible.
Hopefully, with your bug reports and some more of my time, it will get more stable.
Until then, you have been warned.

DEPENDENCIES
========================
MySQL
PHP w/ mod_rewrite
A Brain

TODO
========================
* Explore more DoS possibilities
* Explore more methods of maintaining browser control
* Explore other evil things that could be done with URL shorteners

KNOWN BUGS
========================
* Some URLS get mangled by my escaping. I will fix this eventually,
    but for now it should still work with most.

FOUND BUGS? GOT PATCHES?
========================
Send them to me at supernothing AT spareclockcycles DOT org, or report them
at the Google Code repository: http://code.google.com/p/d0z-me/issues/list

LICENSE
========================
This code is distributed under the GPLv3. See GPL text for more info.
