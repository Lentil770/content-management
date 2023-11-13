# list of tests for Index App

## that should ideally be built, but at minimum a checklist of functionalitys that should work.

(add whenever add new functionality)

## Main Area:

## Pages:

### Videos

-   sidebar show all courses / series within selected filters
-   default paginated list of all videos,
-   new video button, upload videos link to upload page,
-   search bar
-   search should return list of all videos with search term in any of its fields
-   new video should show modal of empty form, submit should add to db correctly and reload with success message
-   click on video should show modal with its data filled in (including categories accessed by id)
-   video modal should have delete and edit button if user is admin/correct role, both should reload with success message with video details.
-   upload videos should link to upload videos page (which on success should return to videos page with success message and details.)
-   category dropdown, on click loads all videos in category
-   search has include filters toggle/checkbox - checked search with selected filters, unchecked search all videos.
-   pagination should show correct number pages and work.
-   in modal, category and course/series dropdowns should work properly to see and edit/select.

### Library

-   default - show : _ list of categorys in sidebar, _ default list of last 15 books, _ new book button, upload books link to upload page, _ search bar
-   search should return list of all books with search term in any of its fields
-   new book should show modal of empty form, submit should add to db and reload with success message
-   click on book should show modal with its data filled in (including categories accessed by id)
-   book modal should have delete and edit button if user is admin/correct role, both should reload with success message with book details.
-   upload books should link to upload books page (which on success should return to books page with success message and details.)
-   pagination should show correct number pages and work.

### Readings

-   sidebar show all current locations - default all level 1
-   show current level locations as flex boxes at top - default all level 1s
-   default paginated list of all readings, currently shows all videos within current level, should probably change to only show if this is videos bottom level.
-   new reading button - opens modal, upload readings link to upload page,
-   search bar should return list of all readings with search term in any of its fields
-   new reading should show modal of empty form, submit should add to db correctly and reload with success message
-   click on reading should show modal with its data filled in (including categories accessed by id)
-   reading modal should have delete and edit button if user is admin/correct role, both should reload with success message with reading details.
-   upload readings should link to upload readings page (which on success should return to readings page with success message and details.)
-   pagination should show correct number pages and work.
-   in modal, location dropdowns should work properly to see and edit/select.

## Misc:

### NavBar

-   show links if logged in and have correct permissions
-   show login if not logged in
-   show name / logout if logged in

## Uploads

X have example excel to download

-   upload button disabled if no file
    X have check if file correct format / excel
-   check if file correct format/headers.

### Readings

### Library

### Videos

## Admin Area

-   not built yet

## Login / Auth

-   if not logged in should be redirected to login page
-   login should only work with @_specified org_.com email.
-   depending on user role with gates, should have access to 3 pages
-   if have edit access on page should have upload / add new btns and be able to edit / delete single result.
