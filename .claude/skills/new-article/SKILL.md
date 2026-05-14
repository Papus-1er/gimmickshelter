# Skill : Nouvel article

## Déclenchement

Utiliser pour créer ou structurer un nouveau contenu : article de news, anachronique (chronique d'album), playlist, ou date de concert. Couvre la structure des champs, les bonnes pratiques éditoriales et la cohérence avec les templates existants.

## Types de contenu disponibles

### 1. Article de news (`post`)

**Template** : `single-post.php`  
**Card** : `parts/card-news.php`  
**Champs ACF** :
- `subtitle_post` — sous-titre (optionnel)
- `image_masthead` — image d'en-tête (optionnel)

**Checklist** :
- [ ] Titre accrocheur
- [ ] Image mise en avant (format `lrg_size` recommandé)
- [ ] Catégorie assignée
- [ ] Extrait rédigé (utilisé dans les cards)
- [ ] Tags pertinents
- [ ] Yoast SEO rempli (titre SEO, méta description)

---

### 2. Anachronique (`anachroniques`)

**Template** : `single-anachroniques.php`  
**Card** : `parts/card-anachronique.php`  
**Champs ACF** :
- `labels` *(obligatoire)* — labels de l'album (ex: "Rock, Shoegaze, 2023")
- `note_generale` *(obligatoire)* — note sur 5

**Checklist** :
- [ ] Titre = "Artiste — Titre de l'album"
- [ ] Image mise en avant = pochette de l'album (format `card-square`)
- [ ] Champ `labels` renseigné
- [ ] Champ `note_generale` entre 1 et 5
- [ ] Corps de l'article : structure recommandée — intro / analyse par titre / conclusion
- [ ] Extrait = accroche de la chronique
- [ ] Yoast SEO rempli

---

### 3. Playlist (`playlists`)

**Template** : `single-playlists.php`  
**Card** : `parts/card-playlists.php`  
**Champs ACF** :
- `sous-titre-playlist` — sous-titre descriptif (optionnel)

**Checklist** :
- [ ] Titre évocateur
- [ ] Image mise en avant représentative
- [ ] Sous-titre si besoin (ambiance, thème)
- [ ] Corps : liste des titres avec lien embed si possible
- [ ] Extrait rédigé

---

### 4. Date / Concert (`dates`)

**Template** : `single-dates.php`  
**Archive** : `archive-dates.php`  
**Page calendrier** : `page-calendrier.php`

**Checklist** :
- [ ] Titre = "Artiste — Salle — Ville"
- [ ] Date dans le titre ou le corps
- [ ] Image mise en avant (affiche ou photo de l'artiste)
- [ ] Informations pratiques dans le corps (lieu, heure, billetterie)
