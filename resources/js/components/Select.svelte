<script>
    import "choices.js/public/assets/styles/choices.min.css";
    import { onMount } from "svelte";

    let {options} = $props();

    let selectRef = null;
    let selected = $state();

    let choices;

    onMount(async () => {
        if (selectRef) {
            const Choices = (await import("choices.js")).default;
            choices = new Choices(selectRef, {
                placeholder: "Choose choice...",
                choices: options
            });
        }
    });

    export const updateOptions = () =>{
        choices.setChoices(
            options,
            'value',
            'label',
            true,
            true,
            true
        );
    }

    export const getSelected = () =>{
        return selected;
    }
</script>

<select bind:this={selectRef} bind:value={selected} onchange={() => {console.log(selected);}}>
    <option value="">Select an option</option>
<!--    <option value="apple">Apple</option>-->
<!--    <option value="banana">Banana</option>-->
<!--    <option disabled value="orange">Orange</option>-->
<!--    <option value="carrot">Carrot</option>-->
<!--    <option value="broccoli">Broccoli</option>-->
<!--    <option value="spinach">Spinach</option>-->
</select>
