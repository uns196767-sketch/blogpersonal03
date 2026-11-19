<?php
/*****
BITÁCORA — AYRTON PALOMINO
Fotos reales de la Universidad Nacional del Santa (Wikimedia Commons, licencia libre).
Se cargan desde internet. Para usar fotos propias, cambia "url" por "img/tu-foto.jpg".
Si una foto no carga, se muestra la ilustración img/uns-campus.svg.
*****/

$commons = "https://commons.wikimedia.org/wiki/Special:FilePath/";

$campus = [
  "titulo"    => "El Santa",
  "subtitulo" => "Universidad Nacional del Santa",
  "direccion" => "Av. Pacífico 508, Nuevo Chimbote",
  "cita"      => "Aquí aprendí que la ingeniería empieza cuando alguien tiene un problema real y tú decides quedarte a resolverlo.",
  "respaldo"  => "img/uns-campus.svg",
  "principal" => [
    "url"    => $commons . "Biblioteca_Central_de_la_Universidad_Nacional_del_Santa.jpg?width=2000",
    "pie"    => "Biblioteca Central",
    "fuente" => "https://commons.wikimedia.org/wiki/File:Biblioteca_Central_de_la_Universidad_Nacional_del_Santa.jpg",
  ],
  "galeria" => [
    [
      "url"    => $commons . "Escuela_Profesional_de_Ingenier%C3%ADa_en_Energ%C3%ADa_de_la_Universidad_Nacional_del_Santa.jpg?width=1000",
      "pie"    => "Pabellón de Ingeniería",
      "fuente" => "https://commons.wikimedia.org/wiki/File:Escuela_Profesional_de_Ingenier%C3%ADa_en_Energ%C3%ADa_de_la_Universidad_Nacional_del_Santa.jpg",
    ],
    [
      "url"    => $commons . "Interior_de_la_Biblioteca_Central_de_la_Universidad_Nacional_del_Santa.jpg?width=1000",
      "pie"    => "Interior de la Biblioteca Central",
      "fuente" => "https://commons.wikimedia.org/wiki/File:Interior_de_la_Biblioteca_Central_de_la_Universidad_Nacional_del_Santa.jpg",
    ],
    [
      "url"    => $commons . "Patio_de_la_UNS.jpg",
      "pie"    => "Patio de la UNS",
      "fuente" => "https://commons.wikimedia.org/wiki/File:Patio_de_la_UNS.jpg",
    ],
  ],
];
?>
