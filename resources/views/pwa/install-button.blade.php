<button
    id="install-button"
    hidden
    type="button"
>
    Install
</button>

<script>
    let installPrompt = null;

    const installButton = document.querySelector("#install-button");

    window.addEventListener("beforeinstallprompt", (event) => {
        console.log("beforeinstallprompt: Install button is visible.");

        event.preventDefault();
        installPrompt = event;

        installButton.removeAttribute("hidden");
    });

    installButton.addEventListener("click", async () => {
        if (!installPrompt) {
            return;
        }

        const result = await installPrompt.prompt();

        console.log(`Install prompt was: ${result.outcome}`);

        installPrompt = null;

        installButton.setAttribute("hidden", "");
    });
</script>

<style>
    #install-button {
    font-size: 20px;          /* Increases the size of the text inside the button */
    padding: 10px 20px;       /* Increases the space around the text inside the button */
    width: auto;              /* Allows the button to adjust its width automatically based on its content */
    height: auto;             /* Adjusts the height based on content and padding */
    border-radius: 10px;      /* Adds rounded corners to the button */
    border-width: 1px;        /* Sets a thin border */
    border-style: solid;      /* Sets the border style to solid */
    border-color: #000;       /* Sets the border color to black (or any other color you prefer) */
    transition: all 0.3s ease; /* Adds a transition for smooth hover effect */
    }

    #install-button:hover {
    background-color: #0585C1;  /* Change background color on hover */
    border-color: #555;         /* Optionally change border color on hover */
    color: #000;                /* Change text color on hover */
    }
</style>
