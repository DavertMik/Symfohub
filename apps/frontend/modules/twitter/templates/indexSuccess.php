<h1>Twitter tweets List</h1>

<table>
  <thead>
    <tr>
      <th>Screen name</th>
      <th>User</th>
      <th>Native</th>
      <th>Raw xml</th>
      <th>Parsed text</th>
      <th>Created at</th>
      <th>Fetched at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($twitter_tweets as $twitter_tweet): ?>
    <tr>
      <td><?php echo $twitter_tweet->getScreenName() ?></td>
      <td><?php echo $twitter_tweet->getUserId() ?></td>
      <td><a href="<?php echo url_for('twitter/edit?native_id='.$twitter_tweet->getNativeId()) ?>"><?php echo $twitter_tweet->getNativeId() ?></a></td>
      <td><?php echo $twitter_tweet->getRawXml() ?></td>
      <td><?php echo $twitter_tweet->getParsedText() ?></td>
      <td><?php echo $twitter_tweet->getCreatedAt() ?></td>
      <td><?php echo $twitter_tweet->getFetchedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('twitter/new') ?>">New</a>
