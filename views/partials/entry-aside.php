<style>
.uk-moderation-element .uk-badge {
  min-width: 90px;
  text-align: left;
  padding: 6px 8px;
}
.uk-moderation-Unpublished .uk-badge {
  background-color: #d85030;
  color: #ffffff;
}
.uk-moderation-Draft .uk-badge {
  background-color: #e28327;
  color: #ffffff !important;
}
.uk-moderation-Published .uk-badge {
  background-color: #659f13;
  color: #ffffff !important;
}
</style>

<div class="uk-margin moderation-status" if="{field && field.length && moderation_field}">
  <div class="uk-width-1-1 uk-form-select uk-moderation-element uk-moderation-{ entry[moderation_field] }">
    <label class="uk-text-small">@lang('Moderation Status:')</label>
    <div class="uk-margin-small-top">
      <span class="uk-badge uk-badge-outline">
        <i if="{entry[moderation_field] == 'Unpublished'}" class="uk-icon-circle-o"></i>
        <i if="{entry[moderation_field] == 'Draft'}" class="uk-icon-pencil"></i>
        <i if="{entry[moderation_field] == 'Published'}" class="uk-icon-circle"></i>
        @lang("{entry[moderation_field]}")
      </span>
    </div>
    <select bind="entry.{moderation_field}">
      <option selected="{ entry[moderation_field] === 'Unpublished' }" value="Unpublished">@lang('Unpublished')</option>
      <option selected="{ entry[moderation_field] === 'Draft' }" value="Draft">@lang('Draft')</option>
      <option selected="{ entry[moderation_field] === 'Published' }" value="Published">@lang('Published')</option>
    </select>
  </div>
</div>

<script>
  var $this = this;
  $this.moderation_field = 'status';

  this.on('mount', function() {

    $this.field = this.collection.fields.filter(function(definition) {
      return definition.type === 'moderation';
    });

    if (!$this.field.length || $this.field[0].name === undefined) {
      return;
    }

    $this.moderation_field = $this.field[0].name;

    $this.entry[$this.moderation_field] = $this.entry[$this.moderation_field] || 'Draft';

    window.setTimeout(function() {
      sidebar = document.querySelector('.uk-grid-margin.uk-flex-order-first');
      sidebar.insertBefore(document.querySelector('.moderation-status'), sidebar.childNodes[0]);
    }, 50);

    $this.update();
  });

</script>