import { initScrollReveal } from "./scrollReveal.js";
import { hoverChangeExperience } from "./hoverChangeExperience.js";
import { typeWrite } from "./typeWrite.js";
import { hoverChangeDescription } from "./hoverChangeDescription.js";
import { menu } from "./menu.js";

menu();
initScrollReveal();
typeWrite(document.querySelector(".typewriter"));

hoverChangeExperience(
  ".digitalhouse",
  `Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
  Aperiam corporis dignissimos illum, impedit incidunt iure odio quasi ratione velit voluptas! 
  Assumenda debitis dicta doloribus fugiat ipsam porro possimus quaerat quibusdam ! 
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. A assumenda consequuntur ducimus fugit 
  laborum maiores maxime nihil omnis porro quibusdam quod repellat repellendus saepe, sint soluta temporibus 
  totam veritatis voluptas.`,
  "Ingénieur études et développements",
  "Webnet",
  "Novembre 2021 - Maintenant (2 ans)"
);

hoverChangeExperience(
  ".zuplae",
  `Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
  Aperiam corporis dignissimos illum, impedit incidunt iure odio quasi ratione velit voluptas! 
  Assumenda debitis dicta doloribus fugiat ipsam porro possimus quaerat quibusdam ! 
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. A assumenda consequuntur ducimus fugit 
  laborum maiores maxime nihil omnis porro quibusdam quod repellat repellendus saepe, sint soluta temporibus 
  totam veritatis voluptas.`,
  "Développeur back-end",
  "KeyOpsTech",
  "Octobre 2020 - Octobre 2021 (1 an)"
);

hoverChangeExperience(
  ".codigofontetv",
  `Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
  Aperiam corporis dignissimos illum, impedit incidunt iure odio quasi ratione velit voluptas! 
  Assumenda debitis dicta doloribus fugiat ipsam porro possimus quaerat quibusdam ! 
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. A assumenda consequuntur ducimus fugit 
  laborum maiores maxime nihil omnis porro quibusdam quod repellat repellendus saepe, sint soluta temporibus 
  totam veritatis voluptas.`,
  "Développeur Php/Symfony",
  "Association AKE",
  "Juillet 2020 - Septembre 2020 (3 mois)"
);

hoverChangeExperience(
  ".contweb",
  `Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
  Aperiam corporis dignissimos illum, impedit incidunt iure odio quasi ratione velit voluptas! 
  Assumenda debitis dicta doloribus fugiat ipsam porro possimus quaerat quibusdam ! 
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. A assumenda consequuntur ducimus fugit 
  laborum maiores maxime nihil omnis porro quibusdam quod repellat repellendus saepe, sint soluta temporibus 
  totam veritatis voluptas.`,
  "Alternant Resource Management",
  "Capgemini",
  "Octobre 2018 - Septembre 2019 (1 an)"
);

hoverChangeDescription(
  ".postgresql",
  "PostgreSQL est un système de gestion de base de données relationnelle (SGBDR)."
);
hoverChangeDescription(
  ".js",
  "JavaScript est un langage de programmation de scripts principalement employé dans les pages web interactives et à ce titre est une partie essentielle des applications web."
);
hoverChangeDescription(
  ".git",
  "Git est un logiciel de gestion de versions décentralisé. Il sert dans notre cas à versionner le code produit"
);
hoverChangeDescription(
  ".symfony",
  "Symfony est un ensemble de composants PHP ainsi qu'un framework MVC libre écrit en PHP. Il fournit des fonctionnalités modulables et adaptables qui permettent de faciliter et d’accélérer le développement d'un site web."
);
hoverChangeDescription(
  ".docker",
  "Docker est une plateforme permettant de lancer certaines applications dans des conteneurs. Il nous sert à gagner beaucoup de temps dans nos développement sur tous les sujets d'infrastructure."
);
hoverChangeDescription(
  ".php",
  "Php est un langage de programmation libre, principalement utilisé pour produire des pages Web dynamiques via un serveur web, mais pouvant également fonctionner comme n'importe quel langage interprété de façon locale."
);
hoverChangeDescription(
  ".bootstrap",
  "Bootstrap est une collection d'outils utiles à la création du design (graphisme, animation et interactions avec la page dans le navigateur, etc.) de sites et d'applications web. C'est un ensemble qui contient des codes HTML et CSS, des formulaires, boutons, outils de navigation et autres éléments interactifs, ainsi que des extensions JavaScript en option."
);
hoverChangeDescription(
  ".mysql",
  "MySQL est un système de gestion de bases de données relationnelles (SGBDR) tout comme postgreSQL. Il fait partie des logiciels de gestion de base de données les plus utilisés au monde."
);
hoverChangeDescription(
  ".html",
  "HTML5 (HyperText Markup Language 5) est la dernière révision majeure du HTML (format de données conçu pour représenter les pages web). "
);
