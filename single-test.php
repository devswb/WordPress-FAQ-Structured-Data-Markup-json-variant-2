<?php
  global $schema;
    
  $schema = array(
  '@context'   => "https://schema.org",
  '@type'      => "FAQPage",
  'mainEntity' => array()
  );

  if ( have_rows('faq') ) {

  while ( have_rows('faq') ) : the_row();

        $questions = array(
          '@type'          => 'Question',
          'name'           => get_sub_field('faq_question'),
          'acceptedAnswer' => array(
          '@type' => "Answer",
          'text' => get_sub_field('faq_answer')
          )
        );

      array_push($schema['mainEntity'], $questions);

  endwhile;


  function bakemywp_generate_faq_schema ($schema) {

    global $schema;

    echo '<script type="application/ld+json">'. json_encode($schema) .'</script>';

  }

  add_action( 'wp_footer', 'bakemywp_generate_faq_schema', 20 );

  }
?>
