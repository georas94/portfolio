<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"/>
    <meta name="author" content="Rashid Tamboura"/>
    <meta
            name="description"
            content="Meu nome é Iuri, desenvolvo interfaces modernas e de alta qualidade, concentrado em performance, animações, responsividade e SEO."
    />
    <meta
            name="keywords"
            content="sites, web, desenvolvimento, frontend, iuri silva, ui designer, programador, iuricode, front-end, designer, ui, iuri, freelancer, freela, website, portfólio"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="theme-color" content="#00E5FF"/>
    <meta name="copyright" content="Iuri Silva 2021"/>
    <meta http-equiv="content-language" content="pt-br"/>
    <meta
            property="og:image"
            content="https://iuricode.com/image/preview.png"
    />
    <meta property="og:title" content="Portfólio // Iuri Silva"/>
    <meta property="og:description" content="Portfólio // Iuri Silva"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Archivo:wght@300;400;500;600&display=swap"
            rel="stylesheet"
    />
    <link rel="stylesheet" href="css/style.css"/>
    <link
            rel="shortcut icon"
            href="image/logo-page.svg"
            type="image/x-icon"
    />
    <link rel="icon" href="image/logo-page.svg"/>
    <link rel="apple-touch-icon" href="image/logo-page.svg"/>
    <link rel="canonical" href="https://iuricode.com/"/>
    <script src="js/svg-inject.min.js"></script>
    <title>Rashid Tamboura</title>
</head>

<body>
<header>
    <div class="grid-layout">
        <nav>
            <img
                    onclick="scrollToTop()"
                    src="image/logo-iuricode.svg"
                    alt="iuricode"
                    width="150px"
                    height="25px"
            />
            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="nav-list">
                <li><a href="#s-home">Accueil</a></li>
                <li><a href="#s-about">Qui suis-je ?</a></li>
                <li><a href="#s-experience">Expériences</a></li>
                <li>
                    <a href="#s-services">Services</a>
                </li>
                <li><a href="#s-projects">Projets</a></li>
                <li>
                    <a href="#s-skills">Outils - Langages</a>
                </li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section id="s-home">
        <div class="grid-layout">
            <div id="home">
                <div id="home-container-text">
                    <h1 class="delayMediumReveal">
                        Je vous accompagne dans la mise en place de vos futurs
                        <span>produits digitaux</span> modernes et professionnels.
                    </h1>
                    <p class="typewriter">
                        Concrétisez vos imaginations, démarquez-vous du marché et attirez de nouveaux clients.
                        Parlons-en !
                    </p>

                    <a
                            href="https://fr.linkedin.com/in/rashidtamboura"
                            rel="noopener"
                            target="_blank"
                            class="delayExtraBigReveal"
                    >
                        Linkedin
                    </a>
                </div>

                <img
                        src="image/logo.svg"
                        alt="ìcone iuricode"
                        onload="SVGInject(this)"
                        id="logo"
                        width="500px"
                        height="500px"
                />
            </div>
        </div>
    </section>

    <section id="s-about">
        <div class="grid-layout">
            <div>
                <div id="creator-photo" class="delayMediumReveal">
                    <h3 class="delayExtraBigReveal">Développeur back-end</h3>
                </div>
                <div>
                    <h4 class="delayMediumReveal">Qui suis-je ?</h4>
                    <h2 class="delaySmallReveal">Rashid Tamboura</h2>

                    <p class="delayLargeReveal">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium architecto eaque et
                        facilis qui.
                        Aliquid consequuntur, cum debitis doloremque eaque fugiat laudantium magnam necessitatibus
                        neque, quia
                        reprehenderit rerum! Ea, ullam. Elit debitis doloremque eaque fugiat laudantium magnam.
                    </p>
                    <nav class="delayLargeReveal">
                        <ul>
                            <a
                                    href="https://fr.linkedin.com/in/rashidtamboura/"
                                    rel="noopener"
                                    target="_blank"
                            >
                                <li>
                                    <img
                                            src="icons/linkedin.svg"
                                            rel="noopener"
                                            alt="Ícone do LinkedIn"
                                            onload="SVGInject(this)"
                                    /></li
                                >
                            </a>
                            <a
                                    style="margin-left: 5em;"
                                    href="https://github.com/georas94"
                                    rel="noopener"
                                    target="_blank"
                            >
                                <li>
                                    <img
                                            src="icons/github.svg"
                                            alt="Ícone do GitHub"
                                            onload="SVGInject(this)"
                                    />
                                </li>
                            </a>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section id="s-experience">
        <div class="grid-layout">
            <h2 class="delaySmallReveal">Expériences <span>.</span></h2>
            <div id="experience">
                <div
                        class="option-experience intervalCardReveal"
                        id="experience-company"
                >
                    <div class="company digitalhouse activeExperience">
                        <h3>Webnet</h3>
                    </div>
                    <div class="company zuplae">
                        <h3>KeyOpsTech</h3>
                    </div>
                    <div class="company codigofontetv">
                        <h3>Association AKE</h3>
                    </div>
                    <div class="company contweb">
                        <h3>Capgemini</h3>
                    </div>
                </div>
                <div class="text-experience intervalCardReveal">
                    <div>
                        <h4 class="titleExperience">
                            Ingénieur études et développements
                        </h4>
                        <p class="dateExperience">Novembre 2021 - Maintenant</p>
                    </div>
                    <h5 class="companyExperience">Webnet</h5>
                    <p class="changeExperience">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam corporis dignissimos illum,
                        impedit
                        incidunt iure odio quasi ratione velit voluptas! Assumenda debitis dicta doloribus fugiat ipsam
                        porro
                        possimus quaerat quibusdam ! Lorem ipsum dolor sit amet, consectetur adipisicing elit. A
                        assumenda
                        consequuntur ducimus fugit laborum maiores maxime nihil omnis porro quibusdam quod repellat
                        repellendus
                        saepe, sint soluta temporibus totam veritatis voluptas.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section id="s-services">
        <div class="grid-layout">
            <h2 class="delaySmallReveal">Services <span>.</span></h2>
            <div id="services">
                <article class="intervalCardReveal">
                    <div>
                        <img
                                src="icons/icon-front.svg"
                                width="100px"
                                height="100px"
                                alt="ícone código"
                        />
                    </div>
                    <h3>Développement</h3>
                    <p>
                        Développement de sites web professionnels, blogs, portfolios/site vitrine, site d'e-commerce.
                    </p>
                </article>

                <article class="intervalCardReveal">
                    <div>
                        <img
                                src="icons/icon-design.svg"
                                width="100px"
                                height="100px"
                                alt="ícone layers"
                        />
                    </div>
                    <h3>Seo</h3>
                    <p>
                        Accompagnement dans la mise en place de votre stratégie de référencement.
                    </p>
                </article>

                <article class="intervalCardReveal">
                    <div>
                        <img
                                src="icons/icon-app-design.svg"
                                width="100px"
                                height="100px"
                                alt="ícone imagem"
                        />
                    </div>
                    <h3>Consulting dans la transformation digitale</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid eos eum non officiis omnis
                        optio quam
                        vel voluptas. Asperiores facere incidunt quisquam! Aliquid, asperiores eius ipsum officiis
                        perferendis
                        praesentium rem.
                    </p>
                </article>
            </div>
        </div>
    </section>

    <section id="s-projects">
        <div class="grid-layout">
            <h2 class="delaySmallReveal">Projets <span>.</span></h2>
            <div id="projects">
                <article class="intervalCardReveal expenseReport" style="display: flex; flex-direction: column; justify-content: space-between">
                    <h3>Notes de frais</h3>
                    <p>
                        Site réalisé pour le compte de la MABUCIG.
                        C'est un outil complet de note des frais réalisé en Php avec le framework symfony, mySQL et javascript
                    </p>

                    <a
                            href="https://notes-de-frais.tlabs.digital"
                            rel="noopener"
                            target="_blank"
                            id="expenseReport"
                    >Voir le projet
                    </a>
                </article>

                <article class="intervalCardReveal lobievents" style="display: flex; flex-direction: column; justify-content: space-between">
                    <h3>Lobi Event's</h3>
                    <p>
                        Site vitrine réalise pour le compte de Lobi Event’s. Il présente les différents services ainsi
                        que les informations de contact de l'entreprise.
                    </p>

                    <a
                            href="https://lobievents.tlabs.digital"
                            rel="noopener"
                            target="_blank"
                            id="lobievents"
                    >Voir le projet
                    </a>
                </article>

                <article class="intervalCardReveal barke" style="display: flex; flex-direction: column; justify-content: space-between">
                    <h3>Barke</h3>
                    <p>
                        Site en cours de construction. Finalisé, ça sera le site vitrine de l'association Fondation
                        Barke Beidari.
                    </p>
                    <a
                            href="#"
                            rel="noopener"
                            id="barke"
                    >Voir le projet
                    </a>
                </article>
            </div>
            <a
                    href="https://github.com/georas94?tab=repositories"
                    rel="noopener"
                    target="_blank"
                    class="delayExtraBigReveal"
            >Dépôt GitHub</a
            >
        </div>
    </section>

    <section id="s-skills">
        <div class="grid-layout">
            <div id="skills">
                <article id="skills-text">
                    <h2 class="delaySmallReveal">Outils - Langages <span>.</span></h2>
                    <p class="small delayMediumReveal changeDescription">
                        *traverser les cartes avec votre curseur pour les lire*
                    </p>
                </article>

                <div id="skills-cards">
                    <article class="php intervalCardReveal">
                        <img
                                src="icons/php.svg"
                                width="60px"
                                height="60px"
                                alt="Icône de php"
                        />
                    </article>
                    <article class="symfony intervalCardReveal">
                        <img
                                src="icons/symfony.svg"
                                width="60px"
                                height="60px"
                                alt="Icône de symfony"
                        />
                    </article>
                    <article class="docker intervalCardReveal">
                        <img
                                src="icons/docker.svg"
                                width="60px"
                                height="60px"
                                alt="Icône de docker"
                        />
                    </article>
                    <article class="mysql intervalCardReveal">
                        <img
                                src="icons/mysql.svg"
                                width="60px"
                                height="60px"
                                alt="Icône de mysql"
                        />
                    </article>
                    <article class="postgresql intervalCardReveal">
                        <img
                                src="icons/postgresql.svg"
                                width="60px"
                                height="60px"
                                alt="Icône postgresql"
                        />
                    </article>
                    <article class="git intervalCardReveal">
                        <img
                                src="icons/git.svg"
                                width="60px"
                                height="60px"
                                alt="Icône de git"
                        />
                    </article>
                    <article class="js intervalCardReveal">
                        <img
                                src="icons/javascript.svg"
                                width="60px"
                                height="60px"
                                alt="ícone do javascript"
                        />
                    </article>
                    <article class="bootstrap intervalCardReveal">
                        <img
                                src="icons/bootstrap.svg"
                                width="60px"
                                height="60px"
                                alt="Icône de bootstrap"
                        />
                    </article>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="grid-layout">
            <p>
                Copyright © 2023
                <a href="https://tlabs.digital" rel="noopener" target="_blank">
                    tlabs.digital
                </a>
                Tous droits réservés.
            </p>

            <div>
                <p>Powered by</p>
                <img
                        src="icons/iuricode-logo-footer.svg"
                        alt="Logo iuricode"
                />
            </div>
        </div>
    </footer>
</main>

<script src="https://unpkg.com/scrollreveal@4.0.9/dist/scrollreveal.min.js"></script>
<script type="module" src="js/main.js"></script>
<script>
    /***
     * Scroll to the top of the page
     */
    const scrollToTop = () => {
        window.scrollTo(0, 0);
    };
</script>
</body>
</html>
