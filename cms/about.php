<?php include("includes/header.php"); ?>
<?php 
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per = 12; // or set LIMIT in sql
$total = Photo::count_all();
$paginate = new Paginate($page, $items_per, $total);

$sql = "SELECT * FROM photos LIMIT " . $items_per . " OFFSET " . $paginate->offset();
$photos = Photo::find_query($sql);

?>

    <main class="col-lg-12">
        <h1>About</h1>
        <section id="about">
            <img class="img-about" src="file:///Volumes/Seagate%20Expansion%20Drive/Pictures/2016/20160425_160426.jpg" alt="">
            <h4>Who?</h4>
            <p class="txt-about">My name is Mia! I'm a 30-something now in my second career: the tech industry!</p>
            <h4>What?</h4>
            <p class="txt-about">I started off like most highschoolers: in retail. My manager caught wind of my skipping class and started offering me longer, day-time shifts. This opened up some training opportunities; I started dealing with sales reps, placing and receiving orders, and merchandising.</p>
            <p class="txt-about">Over the next decade, my resume read something like department supervisor, team lead, assistant store manager, and finally, sales floor manager. Which was just as boring as it sounds. So I quit!</p>
            <p class="txt-about">Forunately, my highschool days also gave me experience with online forums; specifically vBulletin. Even more fortunate, shortly after I quit (with absolutely no future plans) a friend contacted me with an offer in online community support.</p>
            <p class="txt-about">From here I was able to move within the company, and learn on the job! I found myself in a software testing position! It was not a career I had ever imagined for myself, but I'm so glad to have been set on this path.</p>
            <h4>Where?</h4>
            <p class="txt-about">Toronto, Ontario, Canada is where I was born and raised. I can't argue the convenience of the city; everything is nearby, and usually open. But I've spent my adult life trying to get out of here. It hasn't worked out yet, but I'm still hopeful.</p>
            <h4>When?</h4>
            <p class="txt-about">My first foray in to programming was in 2001: I made HTML + CSS websites to share my pixel art on those online forums, using Notepad, and deployed in FTP. I made websites for my friends as well. In 2003, I took an elective course for Visual Basics. And that's as far as I got.</p>
            <p class="txt-about">It took another 12 years for me to get back in to anything computer-related! But here we are, and I'm having a blast.</p>
            <h4>Why?</h4>
            <p class="txt-about">As a user of tech, you know how quickly everything moves on to "newer and better"? Naturally, the people building the tech need to keep ahead in order to deliver on that. Tech is a continuous learning journey!</p>
            <p class="txt-about">In retail, there was a glass ceiling that I'd never pass. It wasn't exactly motivating. Conversely, in tech, there are so many avenues open to me! It's sometimes difficult to narrow my focus. But I guess that's half the fun!</p>
            <h4>How?</h4>
            <p class="txt-about">There are a lot of languages, and a lot of tools out there. And what you need will vary wildly depending on what you are building (or in my case, testing). Here are some of the languages and tools I have experience with:</p>
            <p class="txt-about">HTML5 | CSS3 | PHP | SQL | Python | JavaScript</p>
            <p class="txt-about">PHPUnit | Cypress | Behat | Jenkins | Ansible | Jira | Trello | Asana | Phabricator | Pivotal Tracker | Git | GitHub | GitLab | BitBuckket | Katalon | Codeception </p>
        </section>
        <section id="projects">
            <h4>Projects</h4>
        </section>
    </main>


<?php include("includes/footer.php"); ?>
