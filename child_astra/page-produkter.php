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

<template>
  <article id="produkt-article">
    <img class="billede1" src="" alt="" />
    <div class="produkt-info">
      <h2></h2>
      <p class="pris"></p>
    </div>
  </article>
</template>

<div id="content" class="site-content clr">
  <div id="primary" class="content-area">
    <main id="main" class="site-main">
      <!-- splashbillede -->
      <img
        class="wp-block-cover__image-background"
        alt="hund og ejer går med ryggen til så man kan se taske, sele og snor fra woofyday"
        src="https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/wp-content/uploads/2022/06/gåtur_v2-scaled.webp"
      />
      <!-- produkter og knapper -->

      <nav id="filtrering">
        <button data-produkt="alle">Alle produkter</button>
      </nav>

      <h1 class="produkttitel">Alle produkter</h1>

      <section class="produktcontainer"></section>

      <!-- poter -->
      <img
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
    <!-- #main -->
    <script>
      let produkter;
      let categories;
      let filterProdukt = "alle";
      let h1 = document.querySelector(".produkttitel");

      // link til wp database alle produkter
      const dbUrl =
        "https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/wp-json/wp/v2/produkt?per_page=100";
      // link til wp database alle kategorier
      const catUrl =
        "https://nannatorp.dk/kea/10_eksamensprojekt/woofydays-wp/wp-json/wp/v2/categories";

      // Henter data ind
      async function hentData() {
        const data = await fetch(dbUrl);
        const catdata = await fetch(catUrl);
        //fylder data i variablerne
        produkter = await data.json();
        categories = await catdata.json();
        console.log(produkter);
        visProdukter();
        opretKnapper();
      }

      // function der opretter knapper med kategori id som data attribut
      function opretKnapper() {
        categories.forEach((cat) => {
          document.querySelector(
            "#filtrering"
          ).innerHTML += `<button class="filter" data-produkt="${cat.id}">${cat.name}</button>`;
        });
        addEventListenersToButton();
      }

      // click eventListener til knapperne. Kigger på knapperi nav

      function addEventListenersToButton() {
        document.querySelectorAll("#filtrering button").forEach((elm) => {
          elm.addEventListener("click", filtrering);
        });
      }

      // filtrere kanpperne når der klikkes
      function filtrering() {
        filterProdukt = this.dataset.produkt;
        console.log(filterProdukt);


        //skrifter overskriften
        h1.textContent = this.textContent;

        visProdukter();
      }

      function visProdukter() {
        console.log(visProdukter);
        let temp = document.querySelector("template");
        let container = document.querySelector(".produktcontainer");

        //ryd visings container inden ny loop/visning
        container.innerHTML = "";

        produkter.forEach((produkt) => {
          //viser produkterne afhæning af hvilken knap der er trykket på
          if (
            filterProdukt == "alle" ||
            produkt.categories.includes(parseInt(filterProdukt))
          ) {
            //klon template og indsæt data fra JSON
            let klon = temp.cloneNode(true).content;
            klon.querySelector("h2").textContent = produkt.title.rendered;
            klon.querySelector(".pris").textContent = produkt.pris + " kr.";
            klon.querySelector("img").src = produkt.billede[0].guid;

            // klik på et produkt og åbne singleview.
            klon.querySelector("article").addEventListener("click", () => {
              location.href = produkt.link;
            });

            container.appendChild(klon);
          }
        });
      }
      hentData();
    </script>
  </div>
  <!-- #primary -->
</div>
<!-- #content -->

<?php get_footer(); ?>
