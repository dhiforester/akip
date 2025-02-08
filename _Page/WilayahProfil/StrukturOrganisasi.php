<?php
    //Cek Aksesibilitas ke halaman ini
    $IjinAksesSaya=IjinAksessaya($Conn,$SessionIdAkses,'6cNbITLUBZ');
    if(empty($IjinAksesSaya)){
        include "_Page/Error/NoAccess.php";
    }else{
?>
    <script id="code">
        function init() {
            // Since 2.2 you can also author concise templates with method chaining instead of GraphObject.make
            // For details, see https://gojs.net/latest/intro/buildingObjects.html
            const $ = go.GraphObject.make;  // for conciseness in defining templates

            // some constants that will be reused within templates
            var mt8 = new go.Margin(8, 0, 0, 0);
            var mr8 = new go.Margin(0, 8, 0, 0);
            var ml8 = new go.Margin(0, 0, 0, 8);
            var roundedRectangleParams = {
            parameter1: 2,  // set the rounded corner
            spot1: go.Spot.TopLeft, spot2: go.Spot.BottomRight  // make content go all the way to inside edges of rounded corners
            };

            myDiagram =
            $(go.Diagram, "myDiagramDiv",  // the DIV HTML element
                {
                // Put the diagram contents at the top center of the viewport
                initialDocumentSpot: go.Spot.Top,
                initialViewportSpot: go.Spot.Top,
                // OR: Scroll to show a particular node, once the layout has determined where that node is
                // "InitialLayoutCompleted": e => {
                //  var node = e.diagram.findNodeForKey(28);
                //  if (node !== null) e.diagram.commandHandler.scrollToPart(node);
                // },
                layout:
                    $(go.TreeLayout,  // use a TreeLayout to position all of the nodes
                    {
                        isOngoing: false,  // don't relayout when expanding/collapsing panels
                        treeStyle: go.TreeLayout.StyleLastParents,
                        // properties for most of the tree:
                        angle: 90,
                        layerSpacing: 80,
                        // properties for the "last parents":
                        alternateAngle: 0,
                        alternateAlignment: go.TreeLayout.AlignmentStart,
                        alternateNodeIndent: 15,
                        alternateNodeIndentPastParent: 1,
                        alternateNodeSpacing: 15,
                        alternateLayerSpacing: 40,
                        alternateLayerSpacingParentOverlap: 1,
                        alternatePortSpot: new go.Spot(0.001, 1, 20, 0),
                        alternateChildPortSpot: go.Spot.Left
                    })
                });

            // This function provides a common style for most of the TextBlocks.
            // Some of these values may be overridden in a particular TextBlock.
            function textStyle(field) {
            return [
                {
                font: "12px Roboto, sans-serif", stroke: "rgba(0, 0, 0, .60)",
                visible: false  // only show textblocks when there is corresponding data for them
                },
                new go.Binding("visible", field, val => val !== undefined)
            ];
            }

            // define Converters to be used for Bindings
            function theNationFlagConverter(nation) {
                return "assets/img/So/" + nation + "";
            }

            // define the Node template
            myDiagram.nodeTemplate =
            $(go.Node, "Auto",
                {
                locationSpot: go.Spot.Top,
                isShadowed: true, shadowBlur: 1,
                shadowOffset: new go.Point(0, 1),
                shadowColor: "rgba(0, 0, 0, .14)",
                selectionAdornmentTemplate:  // selection adornment to match shape of nodes
                    $(go.Adornment, "Auto",
                    $(go.Shape, "RoundedRectangle", roundedRectangleParams,
                        { fill: null, stroke: "#7986cb", strokeWidth: 3 }
                    ),
                    $(go.Placeholder)
                    )  // end Adornment
                },
                $(go.Shape, "RoundedRectangle", roundedRectangleParams,
                { name: "SHAPE", fill: "#ffffff", strokeWidth: 0 },
                // gold if highlighted, white otherwise
                new go.Binding("fill", "isHighlighted", h => h ? "gold" : "#ffffff").ofObject()
                ),
                $(go.Panel, "Vertical",
                $(go.Panel, "Horizontal",
                    { margin: 8 },
                    $(go.Picture,  // flag image, only visible if a nation is specified
                    { margin: mr8, visible: false, desiredSize: new go.Size(50, 50) },
                    new go.Binding("source", "nation", theNationFlagConverter),
                    new go.Binding("visible", "nation", nat => nat !== undefined)
                    ),
                    $(go.Panel, "Table",
                    $(go.TextBlock,
                        {
                        row: 0, alignment: go.Spot.Left,
                        font: "16px Roboto, sans-serif",
                        stroke: "rgba(0, 0, 0, .87)",
                        maxSize: new go.Size(160, NaN)
                        },
                        new go.Binding("text", "name")
                    ),
                    $(go.TextBlock, textStyle("title"),
                        {
                        row: 1, alignment: go.Spot.Left,
                        maxSize: new go.Size(160, NaN)
                        },
                        new go.Binding("text", "title")
                    ),
                    $("PanelExpanderButton", "INFO",
                        { row: 0, column: 1, rowSpan: 2, margin: ml8 }
                    )
                    )
                ),
                $(go.Shape, "LineH",
                    {
                    stroke: "rgba(0, 0, 0, .60)", strokeWidth: 1,
                    height: 1, stretch: go.GraphObject.Horizontal
                    },
                    new go.Binding("visible").ofObject("INFO")  // only visible when info is expanded
                ),
                $(go.Panel, "Vertical",
                    {
                    name: "INFO",  // identify to the PanelExpanderButton
                    stretch: go.GraphObject.Horizontal,  // take up whole available width
                    margin: 8,
                    defaultAlignment: go.Spot.Left,  // thus no need to specify alignment on each element
                    },
                    $(go.TextBlock, textStyle("headOf"),
                    new go.Binding("text", "headOf", head => "NIP: " + head)
                    ),
                    $(go.TextBlock, textStyle("boss"),
                    new go.Binding("margin", "headOf", head => mt8), // some space above if there is also a headOf value
                    new go.Binding("text", "boss", boss => {
                        var boss = myDiagram.model.findNodeDataForKey(boss);
                        if (boss !== null) {
                            return "Reporting to: " + boss.name;
                        }
                        return "";
                    })
                    )
                )
                )
            );

            // define the Link template, a simple orthogonal line
            myDiagram.linkTemplate =
            $(go.Link, go.Link.Orthogonal,
                { corner: 5, selectable: false },
                $(go.Shape, { strokeWidth: 3, stroke: "#424242" }));  // dark gray, rounded corner links
                // set up the nodeDataArray, describing each person/position
                var nodeDataArray=[
                    <?php
                        $QrySo = "SELECT * FROM struktur_organisasi WHERE id_wilayah='$SessionIdWilayah'";
                        $DataSo  =mysqli_query($Conn, $QrySo);
                        while($x = mysqli_fetch_array($DataSo)){
                            $key= $x["id_struktur_organisasi"];
                            if(!empty($x["part_of"])){
                                $boss= $x["part_of"];
                            }else{
                                $boss="0";
                            }
                            $name= $x["nama"];
                            if(!empty($x["foto"])){
                                $nation= $x["foto"];
                            }else{
                                $nation="No-Image.png";
                            }
                            $title= $x["jabatan"];
                            if(!empty($x["NIP"])){
                                $headOf= $x["NIP"];
                            }else{
                                $headOf="None";
                            }
                            echo '{key:'.$key.', boss:'.$boss.', name: "'.$name.'", nation: "'.$nation.'", title: "'.$title.'", headOf: "'.$headOf.'"},';
                        }
                    ?>
                ];
            // create the Model with data for the tree, and assign to the Diagram
            myDiagram.model =
            new go.TreeModel(
                {
                    nodeParentKeyProperty: "boss",  // this property refers to the parent node data
                    nodeDataArray: nodeDataArray
                }
            );

            // Overview
            myOverview =
            $(go.Overview, "myOverviewDiv",  // the HTML DIV element for the Overview
                { 
                    observed: myDiagram, contentAlignment: go.Spot.Center 
                }
            );   // tell it which Diagram to show and pan
                
        }

        // the Search functionality highlights all of the nodes that have at least one data property match a RegExp
        function searchDiagram() {  // called by button
            var input = document.getElementById("mySearch");
            if (!input) return;
            myDiagram.focus();

            myDiagram.startTransaction("highlight search");

            if (input.value) {
            // search four different data properties for the string, any of which may match for success
            // create a case insensitive RegExp from what the user typed
            var safe = input.value.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            var regex = new RegExp(safe, "i");
            var results = myDiagram.findNodesByExample({ name: regex },
                { nation: regex },
                { title: regex },
                { headOf: regex });
            myDiagram.highlightCollection(results);
            // try to center the diagram at the first node that was found
            if (results.count > 0) myDiagram.centerRect(results.first().actualBounds);
            } else {  // empty string only clears highlighteds collection
            myDiagram.clearHighlighteds();
            }

            myDiagram.commitTransaction("highlight search");
        }
        window.addEventListener('DOMContentLoaded', init);
    </script>
    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                <?php
                    echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                    echo '  Berikut ini adalah halaman untuk mengelola struktur organisasi pemerintahan wilayah.';
                    echo '  Silahkan lakukan pembaharuan apabila terdapat perubahan pada informasi tersebut.';
                    echo '  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-10 mt-3">
                                <b class="card-title"><i class="bi bi-info-circle"></i> Struktur Organisasi</b>
                            </div>
                            <div class="col-md-2 text-center mt-3">
                                <button type="button" class="btn btn-md btn-primary btn-block btn-rounded" data-bs-toggle="modal" data-bs-target="#ModalTambahStrukturOrganisasi" title="Tambah Pengurus Struktur Organisasi">
                                    <i class="bi bi-person-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" id="MenampilkanStrukturOrganisasi">

                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-12 mt-3">
                                <b class="card-title"><i class="bi bi-info-circle"></i> Diagram Struktur Organisasi</b>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sample" style="position: relative;">
                            <div id="myDiagramDiv" style="width: 100%; height: 500px"></div>
                            <div id="myOverviewDiv"></div> <!-- Styled in a <style> tag at the top of the html page -->
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>