<?php
/**
 * Template Name: Geati Maximalist
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GEATI | MAXIMAL</title>
    <style>
        /* MAXIMALIST RESET */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            background: #000; 
            font-family: 'Arial Black', sans-serif; 
            overflow-x: hidden;
            cursor: crosshair;
        }

        /* SECTION 1: THE LOUD HEADLINE */
        .section-1 {
            background: #CBFF00; /* Acid Yellow */
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5%;
        }
        h1 {
            font-size: clamp(4rem, 15vw, 25rem);
            line-height: 0.8;
            color: #000;
            word-break: break-all;
            text-align: center;
        }

        /* SECTION 2: COLOR BLOCKS */
        .section-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            height: 40vh;
        }
        .block {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 900;
            color: #fff;
            transition: 0.2s ease-in-out;
        }
        .block:hover { filter: invert(1); transform: scale(0.95); }
        .b1 { background: #FF007F; } /* Pink */
        .b2 { background: #0029FF; } /* Blue */
        .b3 { background: #FF5C00; } /* Orange */

        /* FLOATING ELEMENT */
        .marquee {
            position: fixed;
            bottom: 20px;
            background: #000;
            color: #CBFF00;
            padding: 10px;
            width: 100%;
            font-size: 1.5rem;
            white-space: nowrap;
            overflow: hidden;
        }
    </style>
</head>
<body>

    <main>
        <section class="section-1">
            <h1>GEATI</h1>
        </section>

        <section class="section-2">
            <div class="block b1">CREATE</div>
            <div class="block b2">DESTROY</div>
            <div class="block b3">REPEAT</div>
        </section>
    </main>

    <div class="marquee">
        STAY LOUD • STAY BOLD • STAY LOUD • STAY BOLD • STAY LOUD • STAY BOLD
    </div>

    <?php wp_footer(); ?>
</body>
</html>