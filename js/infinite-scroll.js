jQuery(function($) {
    var canBeLoaded = true; // true si les posts peuvent être chargés
    var bottomOffset = 200; // Distance depuis le bas de la page pour commencer à charger
    var page = 2; // Page suivante (la première page est déjà chargée)

    // Fonction pour vérifier quand on est en bas de la page
    function checkBottom() {
        if ((window.innerHeight + window.scrollY) >= (document.body.offsetHeight - bottomOffset) && canBeLoaded) {
            canBeLoaded = false; // Ne pas charger de nouveau avant que le précédent soit chargé
            $('#loading').show(); // Affiche le message de chargement

            var data = {
                action: 'load_more_posts', // Action pour WordPress
                page: page,
                security: ajax_obj.nonce // Ajouter le nonce pour la sécurité
            };

            $.post(ajax_obj.ajaxurl, data, function(response) {
                if (response) {
                    $('#post-list').append(response); // Ajoute les posts à la liste
                    canBeLoaded = true; // Les posts peuvent à nouveau être chargés
                    page++; // Incrémente le numéro de la page
                }
                $('#loading').hide(); // Cache le message de chargement
            });
        }
    }

    // Vérifier la position de la page au scroll
    $(window).scroll(function() {
        checkBottom();
    });
});