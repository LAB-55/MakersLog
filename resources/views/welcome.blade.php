<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel And React</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
        <script type="text/babel">
         var HelloComponent = React.createClass({
             render: function() {
                 return (
                     <h1>Hello, World With React!</h1>
                 )
             }
         })
         ReactDOM.render(<HelloComponent />, document.querySelector('#app'))
     </script>
    </head>
    <body>
      <div id="app"></div>
    </body>
</html>
