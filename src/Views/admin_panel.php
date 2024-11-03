<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Admin | SORA </title>
</head>
<body class="bg-sora-secondary flex justify-center items-center h-full">
    <div class=" text-8xl font-bold text-gray-200 " id="message">
        

    </div>
    
</body>

<script>
    document.addEventListener('DOMContentLoaded', ()=>{
        const message = document.querySelector("#message");
        let text = message.textContent;
        let addon = "Hello Admin :)!"
        let speed = 200;
        let cursor_visible = true

    

        for (let i=0; i< addon.length; i++){
            setTimeout(()=>{
                text += addon.charAt(i);
                
                message.textContent = text + (cursor_visible ? "|" : "");
            }, i*speed);
        }
        
        setInterval(() => {
            cursor_visible = !cursor_visible; 
            message.textContent = text + (cursor_visible ? "|" : "");  
        }, 400)
        
    
        
            
       
    })
</script>
</html>
