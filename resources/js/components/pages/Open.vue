<template>
    <div>
        <navbar></navbar>
        <div class="container mt-5">
            <h2>3rd Party Instruction</h2>
            <p>
                Vendor Management
                <span class="text-success">> 3rd Party Instruction</span>
            </p>
            <div class="card mt-4">
                <div class="card-body">
                    <Tabs></Tabs>
                    <CreateButton></CreateButton>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>
<style>
a {
    color: rgb(34, 34, 34) !important;
}

.active {
    color: #28a745 !important;
    border-bottom: 3px solid #28a745 !important;
}
</style>
