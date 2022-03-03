<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <header>
        <div class="flex justify-between items-start p-5">
            <Logo />
            <Nav />
        </div>
    </header>
</template>

<script>
import Logo from "@/components/Logo";
import Nav from "@/components/Nav";

export default {
    name: "Header",
    components: {Nav, Logo},
}
</script>
