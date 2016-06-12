# Highrise Taxonomy UI
A WordPress plugin that allows you to register taxonomies with a different UI than the standard checkbox or tag search input.

If you have ever had a taxonomy associated with posts in WordPress but the default taxonomy UI (checkboxes for hierarchical taxonomies and tags input for non-hierarchical taxomnomies) is not appropriate this plugin could help.

One good example here is where you have a taxonomy when only 1 term should be added to a post, rather than allowing multiple terms to be added. The plugin provides 2 additional UIs for adding taxonomy terms in the form of radio inputs or select (dropdown) input.

## How do I use the new UIs?

Simply really. When registering your taxonomy using `register_taxonomy` there is an argument you can pass called `meta_box_cb`. This tells WordPress which function to use for rendering the meta box on the post edit screen. This plugin provides two functions that you can reference here.

If you want your taxonmoy to have a select input UI then add this into your `register_taxonomy` args.

```php
meta_box_cb	=> 'hdtui_taxonomy_dropdown_meta_box'
```

If you want your taxonmoy to have a radio button UI then add this to your `register_taxonomy` args.

```php
meta_box_cb	=> 'hdtui_taxonomy_radio_meta_box'
```
