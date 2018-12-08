<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
     xmlns:googleplay="https://www.google.com/schemas/play-podcasts/1.0/play-podcasts.xsd"
     xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd">
    <channel>
        <title><?= $podcast['title']; ?></title>
        <language><?= $podcast['language'] ?? 'en-us'; ?></language>
        <description><?= $podcast['description']; ?></description>
        <googleplay:image href="<?= \Lightning\Model\URL::getAbsolute($podcast['image']); ?>" />
        <itunes:image href="<?= \Lightning\Model\URL::getAbsolute($podcast['image']); ?>" />
        <link><?= $podcast['link'] ?? \Lightning\Tools\Configuration::get('web_root'); ?></link>
        <googleplay:category><?= $podcast['google-category']; ?></googleplay:category>
        <googleplay:explicit><?= !empty($podcast['explicit']) ? 'yes' : 'no'; ?></googleplay:explicit>
        <itunes:explicit><?= !empty($podcast['explicit']) ? 'yes' : 'no'; ?></itunes:explicit>
        <itunes:category text="<?= \Lightning\Tools\Scrub::toHTML($podcast['itunes-category']); ?>" />
        <author><?= \Lightning\Tools\Scrub::toHTML($podcast['author']); ?></author>
        <googleplay:author><?= \Lightning\Tools\Scrub::toHTML($podcast['author']); ?></googleplay:author>
        <itunes:author><?= \Lightning\Tools\Scrub::toHTML($podcast['author']); ?></itunes:author>
        <googleplay:email><?= \Lightning\Tools\Scrub::toHTML($podcast['email']); ?></googleplay:email>
        <itunes:owner>
            <itunes:email><?= \Lightning\Tools\Scrub::toHTML($podcast['email']); ?></itunes:email>
            <itunes:name><?= \Lightning\Tools\Scrub::toHTML($podcast['author']); ?></itunes:name>
        </itunes:owner>
        <?php foreach ($episodes as $episode): ?>
            <item>
                <title><?= $episode->title; ?></title>
                <itunes:summary><?= \Lightning\Tools\Scrub::toHTML($episode->description); ?></itunes:summary>
                <enclosure url="<?= \Lightning\Model\URL::getAbsolute($fileHandler->getWebURL($episode->file)); ?>" type="audio/mpeg" length="<?= $fileHandler->getSize($episode->file); ?>" />
                <pubDate><?= date('r', \Lightning\View\Field\Time::jdtounix($episode->date)); ?></pubDate>
                <itunes:duration><?= sprintf('%02d:%02d:%02d', ($episode->duration/3600),($episode->duration/60%60), $episode->duration%60); ?></itunes:duration>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
