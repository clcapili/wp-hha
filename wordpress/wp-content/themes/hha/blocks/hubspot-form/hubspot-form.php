<?php
/**
 * Hubspot Form Block Template.
 *
 * @param   array  $block      The block settings and attributes.
 * @param   string $content    The block inner HTML (empty).
 * @param   bool   $is_preview True during backend preview render.
 * @param   int    $post_id    The post ID the block is rendering content against.
 * @param   array  $context    The context provided to the block by the post or its parent block.
 */

$anchor = '';
if (!empty($block['anchor'])) {
    $anchor = 'id="' . esc_attr($block['anchor']) . '" ';
}

$class_name = 'hubspot-form-block block-placeholder';
if (!empty($block['className'])) {
    $class_name .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $class_name .= ' align' . $block['align'];
}

$hubSpotForms = get_field('hubspot_forms', 'options') ?: [];
$region       = !empty($hubSpotForms['region'])    ? $hubSpotForms['region']    : 'na1';
$portalId     = !empty($hubSpotForms['portal_id']) ? $hubSpotForms['portal_id'] : '5138011';

$formId         = get_field('form_id')          ?: '';
$submitBehavior = get_field('submit_behavior')  ?: '';
$customMessage  = get_field('custom_message')   ?: '';
$customRedirect = get_field('custom_redirect')  ?: '';
$hiddenFields   = get_field('hidden_fields')    ?: [];
$conditional_redirect      = get_field('conditional_redirect');
$conditional_redirect_data = get_field('conditional_redirect_data');

if (!empty($portalId) && !empty($formId)) {
    $form_params = new stdClass();
    $form_params->region   = $region;
    $form_params->portalId = $portalId;
    $form_params->formId   = $formId;

    if ('custom_message' === $submitBehavior && !empty($customMessage)) {
        $form_params->inlineMessage = $customMessage;
    } elseif ('custom_redirect' === $submitBehavior && !empty($customRedirect) && is_array($customRedirect) && isset($customRedirect['url']) && !empty($customRedirect['url'])) {
        $form_params->redirectUrl = esc_url($customRedirect['url']);
    }
    ?>
    
    <div <?php echo $anchor; ?> class="<?php echo esc_attr($class_name); ?>">

        <script>
        (function(){
            callForm();
            
            function callForm() {
                const formArgs = {
                    ...<?php echo wp_json_encode($form_params); ?>,

                    onFormReady: function ($form) {

                        <?php if (!empty($hiddenFields)) : ?>
                            <?php foreach ($hiddenFields as $hiddenField) : ?>
                            {
                                const hiddenEl = $form[0].querySelector("input[name='<?php echo esc_js($hiddenField['name']); ?>']");
                                if (hiddenEl) {
                                    hiddenEl.value = '<?php echo esc_js($hiddenField['value']); ?>';
                                }
                            }
                            <?php endforeach; ?>
                        <?php endif; ?>

                        if (document.body.dataset.partnerId) {
                            const partnerEl = $form[0].querySelector("input[name='partner_interest___most_recent']");
                            if (partnerEl) {
                                partnerEl.value = document.body.dataset.partnerId;
                            }
                        }

                        <?php if ($conditional_redirect && !empty($conditional_redirect_data)) : ?>
                        const condition = <?php echo wp_json_encode($conditional_redirect_data); ?>;

                        if (condition.name && condition.value && condition.link && condition.link.url) {
                            const formEl = $form[0].querySelector(`[name="${condition.name}"]`);
                            if (formEl) {
                                const redirectLink = document.createElement('a');
                                redirectLink.href = condition.link.url;
                                redirectLink.innerText = condition.link.title;
                                redirectLink.classList.add('redirect-link', 'hs-button', 'primary', 'large', 'text-center', 'text-decoration-none');

                                if (condition.link.target && condition.link.target == '_blank') {
                                    redirectLink.target = '_blank';
                                    redirectLink.rel = 'noopener';
                                }


                                const btnContainer = $form[0].querySelector('.actions');
                                if (btnContainer) {
                                    btnContainer.appendChild(redirectLink);
                                }

                                formEl.addEventListener('change', function(e) {
                                    if (e.target.value === condition.value) {
                                        $form[0].classList.add('use-redirect-link');
                                    } else {
                                        $form[0].classList.remove('use-redirect-link');
                                    }
                                });
                            }
                        }
                        <?php endif; ?>
                    }
                };
                
                if (typeof hbspt !== 'undefined' && hbspt.forms && hbspt.forms.create) {
                    hbspt.forms.create(formArgs);
                } else {
                    console.warn('HubSpot script non trovato o non caricato.');
                }
            }
        })();
        </script>
    </div>
    <?php
}
?>
