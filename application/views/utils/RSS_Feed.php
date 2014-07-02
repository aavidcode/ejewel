<?xml version="1.0" encoding="utf-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
 <title>{blog_title}</title>
 <description>{blog_description}</description>
 <link>{blog_link}</link>
 <lastBuildDate>{last_build_date}</lastBuildDate>
 <pubDate>{blog_pub_date}</pubDate>
 <ttl>{ttl}</ttl>
 {item}
 <item>
  <title>{title}</title>
  <description>{description}</description>
  <link>{link}</link>
  <guid isPermaLink="false">{guid}</guid>
  <pubDate>{pub_date}</pubDate>
 </item>
 {item}
</channel>
</rss>