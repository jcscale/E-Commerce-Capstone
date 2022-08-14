

    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Picture</th>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Inventory Count</th>
            <th scope="col">Quantity Sold</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product){?>
                <tr>
                <td><img src="<?=base_url()?>uploads/<?=$product['filename']?>" alt="" height="50" width="50"></td>
                <td><?=$product['id']?></td>
                <td><?=$product['name']?></td>
                <td><?=$product['inventory_count']?></td>
                <td><?=$product['quantity_sold']?></td>
                <td>
                    <!-- <a href="<?=base_url()?>dashboards/delete_product/<?=$product['id']?>" >delete</a> -->
                    <a href="#" data-bs-toggle="modal" data-bs-target="#edit_modal">edit</a>
                    <form action="<?=base_url()?>dashboards/delete_product/<?=$product['id']?>" method="POST">
                        <input class="delete btn btn-danger" type="submit" value="X">
                    </form>
                    
                </td>
            </tr>
            <?php }?>
        </tbody>
    </table>

    <?=$pagination?>
    
