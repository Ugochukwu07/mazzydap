    	            <!-- I have 100 contents
                i want 10 per page
                i want 5 page buttons +/- 25/20 contents

                how contents

                
                -->
                <?php 
                    $resultPerPage = 10;
                    $totalContents = count(selectAll($table));
                    $totalButtons = intdiv($totalContents, $resultPerPage);
                    $currentPage = $_GET['page'];
                    $startContent = $resultPerPage * $currentPage;
                    $pages = selectAllLimits($table, )
                
                ?>
                    
                    <div class="col-12">
                        <nav aria-label="Page navigation">
                          <ul class="pagination">
                            <li class="page-item disabled">
                              <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                              </a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#"></a></li>
                            <li class="page-item"><a class="page-link" href="#"></a></li>
                            <li class="page-item">
                              <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                    </div>