<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">
    <article id="singleview">
      <div class="billedecontainer"></div>
      <div id="innersingleview">
        <h2></h2>
        <p class="pris"></p>
        <a
          class="sizeguide"
          href="https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/storrelsesguide/"
        >
          <button class="sizeguide">Størrelsesguide</button></a
        >
        <p class="hjerte">❤</p>
        <button class="size_s">Lille</button>
        <button class="size_m">Medium</button>
        <button class="size_l">Stor</button>
        <button class="item">- 1 +</button>
        <button class="basket">Læg i indkøbskurv</button>
      </div>
    </article>
    <article id="singleview2">
      <p class="produktbeskrivelse">Produktbeskrivelse</p>
      <p class="underoverskrift-1"></p>
      <p class="beskrivelse-1"></p>
      <p class="underoverskrift-2"></p>
      <p class="beskrivelse-2"></p>
      <p class="underoverskrift-3"></p>
      <p class="beskrivelse-3"></p>
      <p class="underoverskrift-4"></p>
      <p class="beskrivelse-4"></p>
      <p class="underoverskrift-5"></p>
      <p class="beskrivelse-5"></p>
      <p class="underoverskrift-6"></p>
      <p class="beskrivelse-6"></p>
    </article>
    <article id="singleview3">
      <a
        href="https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/produkt/one-of-a-kind-walk-kit/"
      >
        <img id="kiggede1" src="" alt="" />
      </a>
      <div class="border">
        <a
          href="https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/produkt/one-of-a-kind-walk-kit/"
          ><p class="lilla_walk">One of a kind walk kit</p>
          <p class="lilla_pris">575.00 kr.</p></a
        >
      </div>

      <img id="kiggede2" src="" alt="" />
      <div class="border">
        <p class="green_walk">Green like a pro walk kit</p>
        <p class="green_pris">575.00 kr.</p>
      </div>

      <img id="kiggede3" src="" alt="" />

      <div class="border">
        <p class="yellow_walk">VIP yellow walk kit</p>
        <p class="yellow_pris">539.00 kr.</p>
      </div>
    </article>

    <!-- poter -->
    <img
      class="poter_singleview"
      src="https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/wp-content/uploads/2022/06/paws_line3.svg"
      alt="Grafik med farvede poter"
    />
    <!-- poter slut-->
    <!-- footer -->
    <img
      src="https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/wp-content/uploads/2022/06/footer.svg"
      alt="footer med potegrafik og regnbuegrafik"
    />
    <!-- footer slut -->
  </main>
  <script>

      let produkt;

      //link til database med en php snippet med en function der gør vi kan få postens id.
      const url = "https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/wp-json/wp/v2/produkt/"+<?php echo get_the_ID() ?>;


      async function hentData() {
     console.log("hentData");

     const data = await fetch(url);
     produkt = await data.json();
     visProdukter();
      }
      function visProdukter() {
       console.log(produkt.billede.guid);

     document.querySelector("h2").textContent = produkt.title.rendered;
     document.querySelector("#kiggede1").src = produkt.kiggede1.guid;
     document.querySelector("#kiggede2").src = produkt.kiggede2.guid;
     document.querySelector("#kiggede3").src = produkt.kiggede3.guid;
     document.querySelector(".pris").textContent = produkt.pris + " kr.";
    document.querySelector(".underoverskrift-1").textContent =
             produkt.underoverskriftet;
    document.querySelector(".underoverskrift-2").textContent =
             produkt.underoverskriftto;
    document.querySelector(".underoverskrift-3").textContent =
             produkt.underoverskrifttre;
    document.querySelector(".underoverskrift-4").textContent =
             produkt.underoverskriftfire;
    document.querySelector(".underoverskrift-5").textContent =
             produkt.underoverskriftfem;
    document.querySelector(".underoverskrift-6").textContent =
             produkt.underoverskriftseks;
    document.querySelector(".beskrivelse-1").textContent =
             produkt.beskrivelseet;
    document.querySelector(".beskrivelse-2").textContent =
             produkt.beskrivelseto;
    document.querySelector(".beskrivelse-3").textContent =
             produkt.beskrivelsetre;
    document.querySelector(".beskrivelse-4").textContent =
             produkt.beskrivelsefire;
    document.querySelector(".beskrivelse-5").textContent =
             produkt.beskrivelsefem;
    document.querySelector(".beskrivelse-6").textContent =
             produkt.beskrivelseseks;


    let first_iteration = true;

           //et array af billder og det looper vi igennem  med en html streng vi kloner billede containeren
           //og sætter en inner html på med img så den løber igennem billederne til der ikke er flere med forEach
           //hvis false tilføj classen billedeStor, hvis true tilføj ikke.
           produkt.billede.forEach((pic) => {
            let img;
             if (first_iteration) {
                img = `<img class="billedeStor" src="${pic.guid}" alt="" />`;
                first_iteration = false;
              }else{
                img = `<img src="${pic.guid}" alt="" />`;
               }

             document.querySelector(".billedecontainer").innerHTML += img;
           });
      }
      hentData();
  </script>
</div>
<!-- #primary -->

<?php get_footer(); ?>
