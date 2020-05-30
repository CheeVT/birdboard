<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create a Project</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<body>
  <div class="container">
    <h1 class="heading is-l">Create a Project</h1>
    
    <form action="/projects" method="POST">
      @csrf
      <div class="field">
        <label for="title" class="label">Title</label>
        
        <div class="control">
          <input type="text" class="input" name="title" placeholder="Title" />
        </div>
      </div>
      
      <div class="field">
        <label for="title" class="label">Description</label>
        
        <div class="control">
          <textarea class="textarea" name="description" placeholder="Description"></textarea>
        </div>
      </div>
      
      <div class="field">
        <div class="control">
          <button type="submit" class="button is-link">Create Project</button>
        </div>
      </div>
    </form>
  </div>
</body>
</html>