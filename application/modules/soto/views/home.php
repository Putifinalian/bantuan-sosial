<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
<style>
    .swiper {
        width: 70%;
        object-fit: contain;
    }
</style>
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="<?php echo base_url('home'); ?>">Dashboard</a></li>
    </ol>
    <h1 class="page-header mb-3">Dashboard</h1>

    <div class="container">
        <?php
        $imgs = [
            genrateGDLink("1X0cBfgHaDfIgdAF5SYHMdq7aboUsBHkH"),
            genrateGDLink("1kTqrfNUyL7_cX8qOey5wf7DJdjQLM0j4"),
            genrateGDLink("10_jA2rfEArrkFcHM677wwGy97xEtnwch"),
            genrateGDLink("1gHvMfyjZfASMNBRj26gR8fyaRHeEd-7R"),
            genrateGDLink("1U_rZYvk3bBtkTSmbdIx1FhDkjUoGerY9"),
        ];

        function genrateGDLink($link)
        {
            return "https://drive.google.com/uc?export=media&id=$link";
        }
        // $imgs = [
        //     "https://resamja.com/wp-content/uploads/2022/08/WhatsApp-Image-2022-08-16-at-01.39.14.jpeg",
        //     "https://resamja.com/wp-content/uploads/2022/08/WhatsApp-Image-2022-08-16-at-01.39.15.jpeg",
        //     "https://resamja.com/wp-content/uploads/2022/08/WhatsApp-Image-2022-08-16-at-01.39.14-1.jpeg",
        //     "https://resamja.com/wp-content/uploads/2022/08/WhatsApp-Image-2022-08-16-at-01.39.15-2.jpeg",
        //     "https://resamja.com/wp-content/uploads/2022/08/WhatsApp-Image-2022-08-16-at-01.39.15-1.jpeg",
        // ];
        ?>

        <div class="swiper">
            <div class="swiper-wrapper">
                <?php foreach ($imgs as $key => $img) : ?>
                    <div class="swiper-slide">
                        <img src="<?= $img ?>" class="d-block w-100" alt="">
                    </div>
                <?php endforeach ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>

    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
<script>
    const swiper = new Swiper('.swiper', {
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 10 * 1000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
