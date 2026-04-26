<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet User Panel</title>
    
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts for consistency -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style1.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="icon" href="../images/paw.png">
</head>
<body class="flex flex-col md:flex-row">


    <!-- Main Content Area -->
    <main class="main-content">
        <!-- New Navigation Bar -->
        <?php include 'header_panel.php' ?>
        <?php 
            include '../db/db.php'; 
            try{
                if(isset($_GET['id']))
                {
                    $str="delete from pets where pet_id=".$_GET['id']."";
                    mysqli_query($conn,$str);
                    header("Location: index.php");
                
                }
            }
            catch(Exception $e){
                echo "<script>alert('".$e."')</script>";
            }
        ?>
        <!-- User Dashboard Content -->
        <div class="p-6">
            <!-- User Info and Welcome Card -->
            <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                <h3 class="text-xl font-semibold text-dark-pet mb-2">Welcome Back, <?php echo $user_data['name']; ?>! <a href="update.php"><i class="fa-solid fa-pen fa-2xs"></i></a></h3>
                <p class="text-gray-500">Here's a quick overview of your adoption journey.</p>
            </div>

            <!-- Application Cards -->
            <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-md border-b-4 border-primary-pet">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-semibold text-dark-pet">Upcoming Application</h4>
                        <span class="text-primary-pet text-sm">#APP9012</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600"><i class="fas fa-calendar-day mr-2 text-primary-pet"></i> Date: August 28, 2024</p>
                        <p class="text-gray-600"><i class="fas fa-clock mr-2 text-primary-pet"></i> Status: In Review</p>
                        <p class="text-gray-600"><i class="fas fa-dog mr-2 text-primary-pet"></i> Pet: Spot</p>
                        <p class="text-gray-600"><i class="fas fa-info-circle mr-2 text-primary-pet"></i> Notes: Awaiting interview</p>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="#" class="text-primary-pet hover:underline text-sm">View Details</a>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-lg shadow-md border-b-4 border-primary-pet">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-semibold text-dark-pet">Recent Adoption</h4>
                        <span class="text-primary-pet text-sm">#ADPT8910</span>
                    </div>
                    <div class="space-y-2">
                        <p class="text-gray-600"><i class="fas fa-calendar-day mr-2 text-primary-pet"></i> Date: August 17, 2024</p>
                        <p class="text-gray-600"><i class="fas fa-clock mr-2 text-primary-pet"></i> Status: Completed</p>
                        <p class="text-gray-600"><i class="fas fa-cat mr-2 text-primary-pet"></i> Pet: Whiskers</p>
                        <p class="text-gray-600"><i class="fas fa-info-circle mr-2 text-primary-pet"></i> Notes: Enjoying a new home</p>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="#" class="text-primary-pet hover:underline text-sm">View Details</a>
                    </div>
                </div>
            </div> -->

            <!-- My Pets Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-dark-pet mb-4">My Pets</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Profile
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Breed
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Age
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                try{
                                    $str="SELECT pets.*, pettypes.type_name, users.name AS owner_name, users.email
                                        FROM pets
                                        INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
                                        INNER JOIN users ON pets.owner_id = users.user_id
                                        WHERE users.user_id = '$user_data[user_id]'";
                                        $result = mysqli_query($conn, $str);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $images = explode(',', $row['image_url']); 
                                            $firstImage = "../images/".$images[0]; 
                                    ?>
                                    <tr>
                                    <td class="px-5 py-5 border-b border-gray-200  bg-white text-sm"><img src="<?php echo $firstImage; ?>" alt='Profile Picture' class='w-10 h-10 rounded-full'></td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo $row['name']; ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo $row['type_name']; ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo $row['breed']; ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><?php echo $row['age']." years"; ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm <?php echo ($row['status'] == 'adopted') ? 'text-red-500' : 'text-green-500'; ?>"><?php echo $row['status']; ?></td>
                                    <td class="px-5 py-5 border-b border-gray-200 w-5 bg-white text-sm"><a href="?id=<?php echo $row["pet_id"];?>"><button class="btn btn-outline-danger">Remove</button></a> </td>
                                </tr>
                                <?php } 
                                    } catch (Exception $e) {
                                    echo "Error: " . $e->getMessage();
                                    } ?>
                                <tr><td colspan="7" style="text-align: right;"><a href="add_pet.php" class=" btn btn-outline-primary mt-2">Add New Pet</a></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>

            <!-- Adopted Pets Table -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-dark-pet mb-4">My Adopted Pets</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                   Profile
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Type
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Breed
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Age
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $str="SELECT pets.*, pettypes.type_name, adoptionrequests.*
                                    FROM pets
                                    INNER JOIN pettypes ON pets.pet_type_id = pettypes.pet_type_id
                                    INNER JOIN adoptionrequests ON pets.pet_id = adoptionrequests.pet_id
                                    WHERE adoptionrequests.adopter_id = '$user_data[user_id]'";
                                $result = mysqli_query($conn, $str);
                                while($row = mysqli_fetch_assoc($result)) {
                                    $images = explode(',', $row['image_url']); 
                                    $firstImage = "../images/".$images[0];
                                    echo '<tr>';
                                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm"><img src="'.$firstImage.'" alt="'.$row['name'].'" class="w-16 h-16 object-cover rounded-full"></td>';
                                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">'.$row['name'].'</td>';
                                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">'.$row['type_name'].'</td>';
                                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">'.$row['breed'].'</td>';
                                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">'.$row['age'].'</td>';
                                    echo '<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">';

                                    if ($row['status'] == 'pending') {
                                        echo '<span class="text-yellow-500">Pending</span>';
                                    } elseif ($row['status'] == 'accepted') {
                                        echo '<span class="text-green-500">Accepted</span>';
                                    } elseif ($row['status'] == 'rejected') {
                                        echo '<span class="text-red-500">Rejected</span>';
                                    }
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            ?>
                            <!-- <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Max</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Dog</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">Golden Retriever</td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">2024-07-15</td>
                            </tr> -->
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
